<?php

namespace App\Models;

use App\Traits\CRUDImageAttributeTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use CrudTrait, CRUDImageAttributeTrait;
    
    protected $table = 'partners';

    protected $guarded = [];

    public function setImageAttribute($value)
    {
        $attributeName = "image";
        $disk = "public";
        $destinationPath = "images";

        $this->imageUpload($value, $attributeName, $disk, $destinationPath);
    }
}
