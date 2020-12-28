<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';

    protected $fillable = [
        'product_id', 'quantity'
    ];
}
