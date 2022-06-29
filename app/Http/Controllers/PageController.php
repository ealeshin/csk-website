<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('index', [
            'slides' => Slide::getArray(),
            'products' => Product::getPopular()
        ]);
    }
}