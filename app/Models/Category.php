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

    public static function getRootCategories()
    {
        return self::where('active', true)->where('parent_id', null)->get();
    }

    public function hasSubcategories()
    {
        return self::where('parent_id', $this->id)->exists();
    }

    public function getSubcategories()
    {
        return self::where('parent_id', $this->id)->get();
    }

    public function setImagesAttribute($value)
    {
        $attributeName = "image";
        $disk = "public";
        $destinationPath = "categories";

        $this->imageUpload($value, $attributeName, $disk, $destinationPath);
    }
}
