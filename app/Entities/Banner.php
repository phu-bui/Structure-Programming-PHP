<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'image', 'description', 'link', 'status', 'sort_order'
    ];
}
