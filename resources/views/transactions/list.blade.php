@extends('layouts.mainlayout')

@section('title', 'Transaction')

@section('content')

@if(session()->has('sukses'))
  <div class="alert alert-success">
    <strong>Barang berhasil ditambahkan ke Keranjang</strong>
  </div>
@endif
<div class="card">
   <div class="card-header">
      <div class="row">
        <div class="col-lg-7">
           <h4>Items</h4>
        </div>

        <div class="col-lg-4 search">
           <form method="get" action="">
              <div class="justify-content-end input-group">
                <input class="form-control" type="text" name="q" value="{{$request['q'] ?? ''}}" />
                <button type="submit" class="btn btn-secondary btn-sm">Search</button> 
              </div>
	   </form>
	</div>
	<div class="col-lg-1 keranjang">
	   <div class="image">
	@php
	   $keranjang = session('keranjang')
	@endphp
	      <a href="{{route('dashboard.transactions.create')}}"  type="button">
		<img src="{{ asset('storage/cart/cart.png')}}" />
		<span class="total">{{count((array) session('keranjang'))}}</span>
	      </a>
	   </div>
	</div>
      </div>
   </div>

   <div class="card-body p-0">

   @php
     function rupiah($angka) {
     $hasil_rupiah = "Rp ".number_format($angka, 2);
       return $hasil_rupiah;
     }
   @endphp

   @if($items->total())
   <div class="table-responsive">
      <table class="table">
        <tr>
           <th>Nama Barang</th>
           <th>Kategori Barang</th>
           <th>Harga</th>
           <th>Action</th>
	</tr>
	@foreach($items AS $item)
	@if($item->status == 'Ready')
         <tr>
	   <td class="col-title">{{$item->nama}}</td>
	   <td class="col-title">{{$item->category->nama}}</td>
           <td class="col-title">{{rupiah($item->harga_satuan)}}</td>
	   <td>
		<a href="{{route('dashboard.transactions.addKeranjang', $item->id)}}" class="btn btn-sm btn-warning">Add to cart</a>
	   </td> 
	 </tr>
	@endif
        @endforeach
      </table>

   {{ $items->appends($request)->links() }}
   @else
        <h4 class="text-center p-3">Belum ada Barang tersedia<h4>
   @endif
   </div>
   </div>
</div>

@endsection
