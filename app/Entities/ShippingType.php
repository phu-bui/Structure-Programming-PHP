<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ShippingType extends Model
{
    protected $table = 'shipping_types';

    protected $fillable = [
      'name', 'visible'
    ];
}
