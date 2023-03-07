<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'product_name',
        'product_slug',
        'product_price',
        'product_quantity',
        'product_image',
        'Category_name',
        'SubCategory_name',
        'Category_id',
        'SubCategory_id',
        'short_description',
        'long_description',
        'product_status',
    ];
}
