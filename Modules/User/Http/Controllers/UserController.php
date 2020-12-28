<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
}
