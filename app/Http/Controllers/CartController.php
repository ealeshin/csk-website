<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\FormHandler;

class CartController extends Controller
{
    public function add(Request $request)
    {
        return $this->update('add', $request);
    }

    public function delete(Request $request)
    {
        return $this->update('delete', $request);
    }

    public static function getCartCounter(Request $request)
    {
        $count = 0;
        $data = $request->session()->all();
        foreach ($data as $key => $value) {
            if (str_contains($key, 'product_')) {
                $count++;
            }
        }
        return $count;
    }

    public static function getCartArray(Request $request)
    {
        $data = $request->session()->all();
        $cart = [];
        foreach ($data as $key => $value) {
            if (str_contains($key, 'product_')) {
                $id = substr($key, strpos($key, '_') + 1);
                $cart[$id] = $value;
            }
        }
        return $cart;
    }

    public static function getCartArrayOfStrings(Request $request)
    {
        $data = $request->session()->all();
        $result = [];
        foreach ($data as $key => $value) {
            if (str_contains($key, 'product_')) {
                $id = substr($key, strpos($key, '_') + 1);
                $product = Product::find($id);
                if ($product) {
                    array_push($result, $product->name . ' - ' . $value);
                }
            }
        }

        return $result;
    }

    public static function isProductIdAdded(Request $request, $id)
    {
        $result = null;
        $cart = self::getCartArray($request);
        foreach ($cart as $product_id => $count) {
            if ($product_id == $id) {
                $result = $count;
                break;
            }
        }
        return $result;
    }

    public function dump(Request $request)
    {
        $data = $request->session()->all();
        foreach ($data as $key => $value) {
            if (str_contains($key, 'product_')) {
                echo $key . ': ' . $value . '<br>';
            }
        }
    }

    public function order(Request $request)
    {
        $mail = new FormHandler(
            $request['name'],
            $request['phone'],
            $request['email'],
            null,
            $this->getCartArrayOfStrings($request)
        );

        try {
            $mail->sendOrder();
            $request->session()->flush();
            return response()->json($this->successCartResponse("Order sent"), 200);
        } catch (\Exception $e) {
            return response()->json($this->errorCartResponse($e->getMessage), 400);
        }
    }

    public function question(Request $request)
    {
        $mail = new FormHandler(
            $request['name'],
            $request['phone'],
            $request['email'],
            $request['question'],
            []
        );

        try {
            $mail->sendQuestion();
            $request->session()->flush();
            return response()->json($this->successCartResponse("Question sent"), 200);
        } catch (\Exception $e) {
            return response()->json($this->errorCartResponse($e->getMessage), 400);
        }
    }

    private function update($action, $request)
    {
        try {
            $id = $request['id'];
            if ($action === 'add') {
                $count = $request['count'];
                $request->session()->put('product_'.$id, $count);
            } elseif ($action === 'delete') {
                $request->session()->forget('product_'.$id);
            }
            return response()->json($this->successCartResponse("Action: {$action} {$id} - OK"), 200);
        } catch (\Exception $e) {
            return response()->json($this->errorCartResponse($e->getMessage), 400);
        }
    }

    private function successCartResponse($message)
    {
        return [
            'success' => true,
            'message' => $message
        ];
    }

    private function errorCartResponse($message)
    {
        return [
            'success' => false,
            'message' => $message
        ];
    }
}