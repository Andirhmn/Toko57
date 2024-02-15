<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function create() 
    {
	return view('auth/register');
    }

    public function store(Request $request)
    {
	$this->validate($request, [
		'username' => 'required|unique:users',
		'email' => 'required|unique:users',
		'password' => 'required|min:8',
		'password_confirmation' => 'required'
	]);

	$pass_confirm = $request->password_confirmation;

	if($pass_confirm != $request->password) {
	  return redirect()
		->back()
		->withErrors(['password' => 'The password does not match.'])
		->withInput();
	}

	User::create([
	  'username' => $request->username,
	  'email' => $request->email,
	  'password' => hash::make($request->password),
	]);

	return redirect()
		->route('dashboard');
    }
}
