<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'phone_number',
        'city',
        'postcode',
        'product_id',
        'product_quentaty',
        'total_price',
        'status'
      ];
}
