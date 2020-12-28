<?php

namespace App\Services\Utils;
use Illuminate\Support\Facades\Hash;

class HashUtils
{
    public static function check($str, $hashStr){
        return Hash::check($str, $hashStr);
    }
}
