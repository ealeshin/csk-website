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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function getSearchResults()
    {
        return self::where('active', true)->pluck('name', 'id')->toArray();
    }

    public function getRootCategory()
    {
        return Category::find($this->category->parent_id);
    }

    public static function getPopular()
    {
        return self::take(4)->get();
    }

    public function setImagesAttribute($value)
    {
        $attributeName = "images";
        $disk = "public";
        $destinationPath = "products";

        $this->imageMultipleUpload($value, $attributeName, 'image', $disk, $destinationPath, false, 'jpg', 840);
    }
}
