<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Services\Utils\AuthUtils;
use App\Entities\User;
use DB;
use Session;

class UserController extends Controller
{
    public function register(Request $request) {
        $rules = [
            'email' =>'required|email',
            'password' => 'required|min:6'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $data = array();
            $data['name'] = $request->input('name');
            $data['email'] = $request->input('email');
            $data['password'] = Hash::make($request->input('password'));
            DB::table('users')->insert($data);
            Session::put('message', 'Thành công');
            return redirect()->back();
        }
    }

    public function showLoginForm()
    {
        if(session()->has('data-signin')){
            return redirect()->route('web.home');
        }
        return view('login');
    }

    public function login(Request $request) {
        $rules = [
            'email' =>'required|email',
            'password' => 'required|min:6'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $email = $request->input('email');
            $password = $request->input('password');

            $user = User::where('email', $email)->first();
            if(!empty($user) && AuthUtils::attemptLogin($user, 'web', $email, $password, $request->has('remember_me'))){
                $request->session()->put('data-signin', $request->input());
                return redirect()->route('web.home');
            } else {
                return redirect()->back()->withErrors(['email' => 'Email or password incorrect !'])->withInput();
            }
        }
    }

    public function logout(Request $request)
    {
        if(session()->has('data-signin')){
            session()->forget('data-signin');
            return redirect()->route('web.home');
        }
        else{
            return redirect()->route('user.login');
        }

    }

    protected function guard()
    {
        return Auth::guard('web');
    }
}
