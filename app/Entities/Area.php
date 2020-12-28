<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = [
        'province_no', 'name', 'sort_order'
    ];
}
