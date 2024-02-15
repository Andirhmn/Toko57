@extends('layouts.mainlayout')

@section('title', 'Items')
@section('content')
<div class="card">
   <div class="card-header">
      <div class="row">
        <div class="col-lg-11">
           <h3>Items</h3>
	</div>
	<div class="col-lg-1 p-2">
	@if(Auth::user()->role_id == 1 and isset($item))
           <a href="" data-toggle="modal" data-target="#deleteModal" class="btn btn-sm btn-danger">Delete</a>
        @endif
	</div>
      </div>
   </div>

   <div class="card-body">
      <div class="row">
        <div class="col-md-8 offset-md-2">
	   <form action="{{route($url, $item->id ?? '')}}" method="post">
	   @if(isset($item))
	   @method('put')
	   @endif
           @csrf
              <div>
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" value="{{old('nama') ?? $item->nama ?? ''}}" />
                @error('nama')
                   <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
	      <div>
		@php
		  $category_id = $item->category_id ?? '';
		@endphp
                <label for="category_id" class="form-label">Kategori Barang</label>
		<select class="form-select w-50" name="category_id" value="">
		   <option value="">--Pilih Kategori Barang--</option>
                   @foreach($categories AS $category)
                   <option value="{{$category->id}}" @if($category_id == $category->id) ? selected @endif>{{$category->nama}}</option>
                   @endforeach
                </select>
                @error('category_id')
                   <span class="text-danger">{{$message}}</span>
                @enderror
              </div>   
	      <div>
                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                <input type="text" class="form-control" name="harga_satuan" value="{{old('harga_satuan') ?? $item->harga_satuan ?? ''}}" />
                @error('harga_satuan')
                   <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
	      <div>
		@php
		  $status = $item->status ?? '';
		@endphp
	  	<div class="form-check mt-2">
                  <label for="status" class="form-check-label"i >Ready</label>
		  <input type="radio" class="form-check-input" name="status" value="Ready" @if($status == 'Ready') ? checked @endif />
		</div>
	  	<div class="form-check">
                  <label for="status" class="form-check-label" >Sold out</label>
		  <input type="radio" class="form-check-input" name="status" value="Sold_out" @if($status == 'Sold_out') ? checked @endif />
		</div>
                @error('status')
                   <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="mt-3">
                <a class="btn btn-sm btn-secondary" href="{{ route('dashboard.items')}}">Cancel</a>
                <button type="submit" class="btn btn-success btn-sm">{{$button}}</button>
              </div>
           </form>

        </div>
      </div>
   </div>
</div>

@if(isset($item))
<!-- Delete --!>
<div class="modal fade" id="deleteModal">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
           <h5>Delete</h5>
           <button type="button" data-dismiss="modal">X</button>
        </div>

        <div class="modal-body">
           <p>Anda yakin ingin menghapus Item {{$item->nama ?? ''}}</p>
        </div>

        <div class="modal-footer">
           <form action="{{route('dashboard.items.delete', $item->id ?? '')}}" method="post">
           @csrf
           @method('delete')
              <button class="btn btn-sm btn-danger">Delete</button>
           </form>
        </div>
      </div>
   </div>
</div>
@endif
@endsection
