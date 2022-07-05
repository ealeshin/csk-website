<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
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