<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('index', [
            'products' => Product::getPopular()
        ]);
    }

    public function cart(Request $request)
    {
        $items = [];
        $cart = CartController::getCartArray($request);
        foreach ($cart as $id => $count) {
            array_push($items, [
                'product' => Product::find($id) ?? null,
                'count' => $count
            ]);
        }
        return view('cart', [
            'items' => $items
        ]);
    }

    public function contacts()
    {
        return view('contacts');
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
            'products' => Product::getPopular(),
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