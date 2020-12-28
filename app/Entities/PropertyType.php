<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $table = 'property_types';

    protected $fillable = [
      'property_name', 'filterable', 'sort_order'
    ];
}
