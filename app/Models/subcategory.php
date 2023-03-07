<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class subcategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'SubCategory_name',
        'SubCategory_slug',
        'SubCategory_image',
        'Category_id',
        'Category_name',
    ];

}
