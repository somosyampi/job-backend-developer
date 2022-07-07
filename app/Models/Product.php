<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'price',
        'description',
        'category',
        'image_url',
    ];
}
