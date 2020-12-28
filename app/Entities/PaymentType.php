<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $table = 'payment_types';

    protected $fillable = [
        'name', 'visible'
    ];
}
