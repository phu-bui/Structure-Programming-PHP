<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Entities\Admin;
use App\Services\Utils\AuthUtils;


class AdminController extends BaseController
{


    public function showLoginForm()
    {
        return view('user::auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $adminUser = Admin::where('email', $email)->first();
        if(empty($adminUser)) {
            return redirect()->back()->withErrors(['email' => 'Email incorrect !'])->withInput();
        } else if (!AuthUtils::attemptLogin($adminUser, 'admin', $email, $password)){
            return redirect()->back()->withErrors(['password' => 'Password incorrect !'])->withInput();
        }

        return redirect()->route('admin.index');
    }

    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect()->route('admin.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
