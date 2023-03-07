<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addtocard extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'product_quantity',
        'price'
      ];
}
