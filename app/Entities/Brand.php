<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'name', 'logo', 'slug'
    ];
}
