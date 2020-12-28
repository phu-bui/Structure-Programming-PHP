@extends('web::layouts.master')
@section('content')
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form class="user" method="POST" action="{{route('web.post-login') }}" >
                            @csrf
                            <input type="email" placeholder="Email Address" name = "email"/>
                            <input type="password" placeholder="Password" name = "password"/>
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                            @enderror
                            <br>
                            <span>
								<input type="checkbox" class="checkbox">
								Keep me signed in
							</span>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form class="user" method="POST" action="{{route('web.post-register') }}">
                            @csrf
                            <input type="text" placeholder="Name" name="name"/>
                            <input type="email" placeholder="Email Address" name="email"/>
                            <input type="password" placeholder="Password" name="password"/>
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo "<script type='text/javascript'>alert('$message');</script>";
                                Session::put('message', null);
                            }
                            ?>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection
