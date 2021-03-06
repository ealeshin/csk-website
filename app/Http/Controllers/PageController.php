<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Partner;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('index', [
            'products' => Product::getPopular(),
            'partners' => Partner::all()
        ]);
    }

    public function search($q)
    {
        $query = trim($q);
        $products = Product::where('name', 'like', '%'.$query.'%')->get();
        return view('search', [
            'products' => $products,
            'count' => $products->count(),
            'query' => $query
        ]);
    }

    public function cart(Request $request)
    {
        $items = [];
        $cart = CartController::getCartArray($request);
        foreach ($cart as $id => $count) {
            $product = Product::find($id);
            if ($product) {
                array_push($items, [
                    'product' => $product,
                    'count' => $count
                ]);
            } else {
                $request->session()->forget('product_'.$id);
            }
        }
        return view('cart', [
            'items' => $items
        ]);
    }

    public function contacts()
    {
        return view('contacts', [
            'contacts' => Contact::first()
        ]);
    }

    public function about()
    {
        return view('about', [
            'content' => Content::where('page', 'about')->first()
        ]);
    }

    public function catalog()
    {
        return view('catalog', [
            'products' => Product::take(100)->get(),
            'current' => null
        ]);
    }

    public function category($id)
    {
        $category = Category::find($id);
        return view('catalog', [
            'products' => $category->products(),
            'current' => $id
        ]);
    }

    public function product(Request $request, $id)
    {
        $product = Product::find($id);
        return view('product', [
            'product' => $product,
            'category' => $product->getRootCategory(),
            'subcategory' => $product->category,
            'in_cart' => CartController::isProductIdAdded($request, $id)
        ]);
    }
}