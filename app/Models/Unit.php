<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use CrudTrait;
    
    protected $table = 'units';

    protected $guarded = [];
}
