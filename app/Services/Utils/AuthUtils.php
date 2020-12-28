<?php

namespace App\Services\Utils;
use Illuminate\Support\Facades\Auth;


class AuthUtils
{

    public static function attemptLogin($authUser, $guard, $email, $password, $remember = false){
        if($authUser->email == $email && HashUtils::check($password, $authUser->password)){
            Auth::guard($guard)->login($authUser, $remember);
            return true;
        }
        return false;
    }
}
