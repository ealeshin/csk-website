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
        $all = self::where('active', true)->where('parent_id', null)->get();
        $notEmpty = $all->filter(function($category) {
            return $category->isNotEmpty();
        });

        return $notEmpty;
    }

    public function isNotEmpty()
    {
        if (!$this->parent_id) {
            $subcategoriesIdArray = $this->getSubcategories()->pluck('id')->toArray();
            return Product::whereIn('category_id', $subcategoriesIdArray)->where('active', true)->exists();
        } else {
            return Product::where('category_id', $this->id)->where('active', true)->exists();
        }
    }

    public function hasSubcategories()
    {
        return self::where('parent_id', $this->id)->exists();
    }

    public function getSubcategories()
    {
        $all = self::where('parent_id', $this->id)->get();
        $notEmpty = $all->filter(function($category) {
            return $category->isNotEmpty();
        });

        return $notEmpty;
    }

    public function setImagesAttribute($value)
    {
        $attributeName = "image";
        $disk = "public";
        $destinationPath = "categories";

        $this->imageUpload($value, $attributeName, $disk, $destinationPath);
    }
}
