<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\logDB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function index(Request $request, User $users) 
    {
	$q = $request->input('q');
        $users = $users->when($q, function($query) use ($q) {
		return $query->where('username', 'like', '%'.$q.'%')
	       		     ->orwhere('email', 'like', '%'.$q.'%')
			     ->orwhere('role_id', 'like', '%'.$q.'%')
			     ->orwhere('status', 'like', '%'.$q.'%');
	})
			->with('role')
                        ->paginate(7);

        $request = $request->all();
        return view('users/list', ['users' => $users, 'request' => $request]);	
    }
    
    public function edit($id) 
    {
	$user = User::find($id);
    	return view('users/form', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
	$user = User::find($id);
	//	dd($user);
	$user->status = $request->input('status');
	$user->save();

	logDB::record(Auth::user(), 'Mengubah status User');

	return redirect()
		->route('dashboard.users')
		->with('status', 'Perubahan disimpan');
	
    }
}
