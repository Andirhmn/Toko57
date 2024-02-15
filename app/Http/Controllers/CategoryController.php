<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\logDB;
use Validator;

class CategoryController extends Controller
{
    public function index(Request $request, Category $categories)
    {
	$q = $request->input('q');

        $categories = $categories->when($q, function($query) use ($q) {
                        return $query->where('nama', 'like', '%'.$q.'%');
        })
                        ->paginate(6);

        $request = $request->all();
        return view('categories/list', ['categories' => $categories, 'request' => $request]);
    }

    public function create()
    {
	return view('categories/form', ['url' => 'dashboard.categories.store',
				        'button' => 'Simpan']);
    }

    public function store(Request $request, Category $category) 
    {
       	$validator = validator::make($request->all(), [
              'nama' => 'required|unique:App\Models\Category,nama'
       	]);

       	if($validator->fails()) {
		return redirect()
			->route('dashboard.categories.create')
		    	->withErrors($validator)
                    	->withInput();
    	} else {

        $category->nama = $request->input('nama');
        $category->save();

	logDB::record(Auth::user(), 'Menambah Kategori');

        return redirect()
                ->route('dashboard.categories')
                ->with('message', 'Category added successfully');
       	}
    }

    public function edit(Category $category)
    {
	return view('categories/form', ['url' => 'dashboard.categories.update',
					'button' => 'Update',
					'category' => $category]);
    }

    public function update(Request $request, Category $category) 
    {
        $validator = validator::make($request->all(), [
                'nama' => 'required|unique:App\Models\Category,nama,'.$category->id
        ]);

        if($validator->fails()) {
                return redirect()
                        ->route('dashboard.categories', $category->id)
                        ->withErrors($validator)
                        ->withInput();
        } else {

        $category->nama = $request->input('nama');
        $category->save();

	logDB::record(Auth::user(), 'Update Kategori');

        return redirect()
                ->route('dashboard.categories')
                ->with('message', 'Category Changed successfully');
        }

    }

    public function destroy(Request $request, Category $category)
    {
	$category->delete();

	logDB::record(Auth::user(), 'Menghapus Kategori');

	return redirect()
		->route('dashboard.categories')
		->with('message', 'Category Deleted succesfully');
    }
}
