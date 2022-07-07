<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $this->update('add', $request);
    }

    public function delete(Request $request)
    {
        $this->update('delete', $request);
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

    public function get(Request $request)
    {
        $data = $request->session()->all();
        $cart = [];
        foreach ($data as $key => $value) {
            if (str_contains($key, 'product_')) {
                $id = substr($key, strpos($key, '_') + 1);
                $cart[$id] = $value;
            }
        }
        return response()->json([
            'success' => true,
            'data' => $cart
        ], 200);
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