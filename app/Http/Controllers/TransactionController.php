<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Item;
use App\Models\Category;
use App\Models\logDB;
use Validator;

class TransactionController extends Controller
{
    public function index(Request $request, Item $items)
    {
	$q = $request->input('q');

        $items = $items->when($q, function($query) use ($q) {
        	return $query->where('nama', 'like', '%'.$q.'%')
                             ->orwhere('category_id', 'like', '%'.$q.'%')
                             ->orwhere('harga_satuan', 'like', '%'.$q.'%');

 	})
                             ->with('category')
                             ->paginate(6);

	$request = $request->all();
        return view('transactions/list', ['items' => $items, 'request' => $request]);
    }

   public function addKeranjang(Request $request, Item $item)
    {
        $barang_id = $request->item['id'];
        $row = Item::find($barang_id);
        $keranjang = $request->session()->get('keranjang', []);
           $keranjang[$barang_id] = [
                   "nama" => $row->nama,
                   "harga_satuan" => $row->harga_satuan,
                 //  "harga_perpack" => $row->harga_perpack
		   "quantity" => 1
           ];

        session()->put('keranjang', $keranjang);
        return redirect()
                ->back()
                ->with('sukses', 'Barang berhasil ditambahkan ke keranjang');
   }

    public function create(Request $request) 
    {
	if($request->session()->get('keranjang')) {
	  $keranjang = $request->session()->get('keranjang');
	  return view("transactions/form", ['keranjang' => $keranjang]);
	} else {
	  return redirect()
		->route('dashboard.transactions');
	}
    }

    public function updateQuantity(Request $request)
    {
    	if($request->id && $request->quantity) {
	  $keranjang = $request->session()->get("keranjang");
	  $keranjang[$request->id]['quantity'] = $request->quantity;

	  session()->put("keranjang", $keranjang);
	}
    }

    public function destroy(Request $request)
    {
    	if($request->id) {
	  $keranjang = $request->session()->get("keranjang");
	  if(isset($keranjang[$request->id])) {
	    unset($keranjang[$request->id]);
	    session()->put("keranjang", $keranjang);
	  }
	}
    }

    public function destroySession()
    {
 	session()->forget('keranjang');
 	session()->forget('bayar');
	return redirect()
		->back();
    } 

    public function updateBayar(Request $request)
    {
	$bayar = $request->pembayaran;

	session()->put("bayar", $bayar);
	return redirect()
		->back();
    }

}
