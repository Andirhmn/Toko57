<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function scan() 
    {
      	return view('auth/qrcode');
    }

    public function qrcode(Request $request)
    {
	$result = 0;
	$id = User::where('password', $request->qr_code)->first();
	  if(!$id) {
	    $result = 0;
	  } else if($id->status == 'active') {
	    Auth::login($id);
	    $result = 2;
	  } else if($id->status == 'inactive') {
	    $result = 1;  
	  }

	return $result;	
    }

    public function login() 
    {
      	return view('auth/login');
    }

    public function auth(Request $request)
    {
    	$credentials = $request->validate([
                'email' => ['required'],     
                'password' => ['required']
        ]);

	if(Auth::attempt($credentials)) {
	   //cek jika usernya tidak active tidak bisa masuk
           if(Auth::user()->status != 'active') {

              Auth::logout();
              $request->Session()->invalidate();
              $request->Session()->regenerateToken();

	      Session::flash('status', 'failed');
              Session::flash('message', 'Akun anda belum aktif, silahkan hubungi Admin.');
	      return redirect()
		->route('login')
	      	->withInput();

	   } else {

	   $request->session()->regenerate();
	   return redirect()
	 	->route('dashboard');
	   }
	} 
                //cek jika usernya belum punya akun
        // Session::flash('status', 'failed');
        // Session::flash('message', 'Login gagal, email atau password yang anda masukkan tidak cocok!');
	return redirect()
		->route('login')
		->withErrors(['email' => 'Login gagal', 'password' => 'Login gagal, email atau password yang anda masukkan tidak cocok!'])
		->withInput();
    }

    public function logout(Request $request) 
    {
    	Auth::logout();
	$request->session()->invalidate();
	$request->session()->regenerateToken();
	return redirect()
		->route('login');
    }
}
