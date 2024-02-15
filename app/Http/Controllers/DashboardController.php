<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\user;
use App\Models\logDB;

class DashboardController extends Controller
{
    public function index(Request $request, logDB $logs)
    {
	$items = Item::count();
	$categories = Category::count();
	$users = User::count();
//	logDB::latest()->paginate(4);
	
	$q = $request->input('q');

	$logs = logDB::latest()->when($q, function($query) use ($q) {
		return $query->where('user_id', 'like', '%'.$q.'%')
			     ->orwhere('extra', 'like', '%'.$q.'%')
			     ->orwhere('created_at', 'like', '%'.$q.'%');
	})
			     ->paginate(4);	

	$request = $request->all();
	return view('dashboard', ['items' => $items, 
				  'categories' => $categories,
				  'users' => $users,
				  'logs' => $logs,
				  'request' => $request]);
    }

}
