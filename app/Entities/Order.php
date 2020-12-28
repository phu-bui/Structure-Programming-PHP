<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
      'order_no', 'customer_name', 'phone_number', 'email', 'area_id', 'address', 'note', 'payment_type_id', 'payment_status', 'shipping_type_id', 'shipping_status', 'total_prices', 'order_date', 'order_status'
    ];
}
