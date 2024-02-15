@extends('layouts.mainlayout')

@section('title', 'Items')

@section('content')


@if(session('Sukses'))
  <div class="alert alert-success">
    {{session('Sukses')}}
  </div>
@endif

<div class="mb-2">
   <a href="{{route('dashboard.items.create')}}" class="btn btn-primary-outline">+ Item</a>
</div>
<div class="card">
   <div class="card-header">

      <div class="row">
        <div class="col-lg-8">
           <h4>Items</h4>
        </div>

        <div class="col-lg-4 search">
           <form method="get" action="">
              <div class="justify-content-end input-group">
                <input type="text" class="form-control" name="q" value="{{$request['q'] ?? ''}}" />
                <button type="submit" class="btn btn-secondary btn-sm">Search</button> 
              </div>
	   </form>
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
	   <th>#</th>
           <th>Nama Barang</th>
           <th>Kategori Barang</th>
           <th>Harga</th>
           <th>Status</th>
           <th>Action</th>
	</tr>
        <tr>
	@foreach($items AS $item)
	   <td>{{($items->currentPage() - 1) * $items->perPage() + $loop->iteration}}</td>
	   <td class="col-title">{{$item->nama}}</td>
	   <td class="col-title">{{$item->category->nama}}</td>
           <td class="col-title">{{rupiah($item->harga_satuan)}}</td>
           <td class="col-title" @if($item->status == 'Ready') ? style='color: blue;' @else style='color: red;' @endif >{{$item->status}}</td>
	   <td>
		<a href="{{route('dashboard.items.edit', $item->id)}}" class="btn btn-sm btn-success">Edit</a>
	   </td> 
        </tr>
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
