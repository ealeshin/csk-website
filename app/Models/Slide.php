<?php

namespace App\Models;

use App\Traits\CRUDImageAttributeTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use CrudTrait, CRUDImageAttributeTrait;
    
    protected $table = 'slides';

    protected $guarded = [];

    public function setImageAttribute($value)
    {
        $attributeName = "image";
        $disk = "public";
        $destinationPath = "slides";

        $this->imageUpload($value, $attributeName, $disk, $destinationPath);
    }
}
