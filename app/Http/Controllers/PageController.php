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

    public function product()
    {
        abort(404);
    }
}