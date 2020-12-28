<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';

    protected $fillable = [
      'property_type_id', 'product_id', 'value', 'filterable'
    ];
}
