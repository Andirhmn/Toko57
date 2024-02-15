<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Item;
use App\Models\Category;
use App\Models\logDB;
use Validator;

class ItemController extends Controller
{
    public function index(Request $request, Item $items)
    {
	$q = $request->input('q');
        $items = $items->when($q, function($query) use ($q) {
		return $query->where('nama', 'like', '%'.$q.'%')
			     ->orwhere('category_id', 'like', '%'.$q.'%')
			     ->orwhere('harga_satuan', 'like', '%'.$q.'%')
			     ->orwhere('status', 'like', '%'.$q.'%');
		     	     
	})
		 	->with('category')
		       	->paginate(6);

	$request = $request->all();
	return view('items/list', ['items' => $items, 'request' => $request]);
    }

    public function create()
    {
	
	$categories = Category::all();
    	return view('items.form', ['url' => 'dashboard.items.store',
				   'button' => 'Simpan',
				   'categories' => $categories]);
    }

    public function store(Request $request, Item $item) 
    {
        $validator = validator::make($request->all(), [
              'nama' => 'required',
              'category_id' => 'required',
              'harga_satuan' => 'required',
              'status' => 'required',
	]);

        if($validator->fails()) {
                return redirect()
                        ->route('dashboard.items.create')
                        ->withErrors($validator)
                        ->withInput();
        } else {

        $item->nama = $request->input('nama');
        $item->category_id = $request->input('category_id');
        $item->harga_satuan = $request->input('harga_satuan');
        $item->status = $request->input('status');
	$item->save();

	logDB::record(Auth::user(), 'Menambah Item');

        return redirect()
                ->route('dashboard.items')
                ->with('status', 'Item added successfully');
        }
    }

    public function edit(Item $item)
    {
	$categories = Category::all();
    	return view('items.form', ['url' => 'dashboard.items.update',
				   'button' => 'Update',
				   'item' => $item,
				   'categories' => $categories]);
    }

    public function update(Request $request, Item $item) 
    {
        $validator = validator::make($request->all(), [
              'nama' => 'required',
              'category_id' => 'required',
              'harga_satuan' => 'required',
              'status' => 'required',
        ]);

        if($validator->fails()) {
                return redirect()
                        ->route('dashboard.items.edit', $item->id)
                        ->withErrors($validator)
                        ->withInput();
        } else {

        $item->nama = $request->input('nama');
        $item->category_id = $request->input('category_id');
        $item->harga_satuan = $request->input('harga_satuan');
        $item->status = $request->input('status');
	$item->save();

	logDB::record(Auth::user(), 'Update Produk');

        return redirect()
                ->route('dashboard.items')
                ->with('status', 'Items update successfully');
        }
    }

    public function destroy(Request $request, Item $item) 
    {
        $item->delete();
	logDB::record(Auth::user(), 'Menghapus Item');

        return redirect()
                ->route('dashboard.items')
                ->with('status', 'Item Deleted Succesfully');
    }

}
