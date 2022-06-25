<?php

namespace App\Models;

use App\Traits\CRUDImageAttributeTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait, CRUDImageAttributeTrait;
    
    protected $table = 'products';

    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
    ];

    public function setImagesAttribute($value)
    {
        $attributeName = "images";
        $disk = "public";
        $destinationPath = "products";

        $this->imageMultipleUpload($value, $attributeName, 'image', $disk, $destinationPath, true, 'jpg', 840);
    }
}
