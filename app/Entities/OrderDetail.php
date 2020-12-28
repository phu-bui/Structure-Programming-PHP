<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $fillable = [
      'order_id', 'product_id', 'quantity'
    ];
}
