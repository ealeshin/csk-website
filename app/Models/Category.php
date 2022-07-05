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

    public function products()
    {
        return $this->checkProducts(true);
    }

    public function isNotEmpty()
    {
        return $this->checkProducts();
    }

    public function checkProducts($get = false)
    {
        $method = $get ? 'get' : 'exists';
        if (!$this->parent_id) {
            $subcategoriesIdArray = $this->getSubcategories()->pluck('id')->toArray();
            return Product::whereIn('category_id', $subcategoriesIdArray)->where('active', true)->{$method}();
        } else {
            return Product::where('category_id', $this->id)->where('active', true)->{$method}();
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
