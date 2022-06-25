<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait;
    
    protected $table = 'products';

    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
    ];
}
