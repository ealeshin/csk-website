<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('index', [
            'products' => Product::getPopular()
        ]);
    }

    public function contacts()
    {
        return view('contacts');
    }

    public function catalog()
    {
        return view('catalog', [
            'products' => Product::getPopular()
        ]);
    }

    public function product($id)
    {
        $product = Product::find($id);
        return view('product', [
            'product' => $product,
            'category' => $product->getRootCategory(),
            'subcategory' => $product->category
        ]);
    }
}