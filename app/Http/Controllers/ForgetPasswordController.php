<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function request()
    {
     	return view('auth.forgot-password');
    }

    public function requestProcess(Request $request)
    {
	$request->validate(['email' => 'required|email']);

    	$status = Password::sendResetLink(
	  $request->only('email')
	);

	return $status === Password::RESET_LINK_SENT
		? back()
		  ->with(['status' => __($status)])
		  ->withInput()
	  	: back()
		  ->withErrors(['email' => __($status)])
		  ->withInput();
    }

    public function reset($token)
    {
     	return view('auth.reset-password', ['token' => $token]);
    }

    public function resetProcess(Request $request)
    { 
    	$request->validate([
        	'token' => 'required',
        	'email' => 'required|email',
        	'password' => 'required|min:8|confirmed'
    	]);
 
    	$status = Password::reset (
          $request->only('email', 'password', 'token'),
          function ($user, $password) {
            $user->forceFill([
        	'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
          }
    	);
 
    	return $status === Password::PASSWORD_RESET
               	? redirect()->route('login') // ->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
    }

}
