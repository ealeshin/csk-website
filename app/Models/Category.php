<?php

namespace App\Models;

use App\Traits\CRUDImageAttributeTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CrudTrait, CRUDImageAttributeTrait;
    
    protected $table = 'categories';

    protected $guarded = [];

    public function setImagesAttribute($value)
    {
        $attributeName = "image";
        $disk = "public";
        $destinationPath = "categories";

        $this->imageUpload($value, $attributeName, $disk, $destinationPath);
    }
}
