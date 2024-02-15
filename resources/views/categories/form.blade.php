

@extends('layouts.mainlayout')

@section('title', 'Categories')

@section('content')
<div class="card">
   <div class="card-header">
      <div class="row">
        <div class="col-lg-11">
           <h3>Categories</h3>
	</div>
	<div class="col-lg-1 p-2">
	@if(Auth::user()->role_id == 1 and isset($category))
	   <button type="button" class="btn btn-sm btn-danger" data-target="#deleteModal" data-toggle="modal">Delete</button>
	@endif
	</div>
      </div>
   </div>
   
   <div class="card-body">
      <div class="row">
        <div class="col-md-8 offset-md-2">
	   <form action="{{route($url, $category->id ?? '')}}" method="post">
	   @if(isset($category))
	      @method('put')
	   @endif
           @csrf
              <div>
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama Kategori" value="{{$category->nama ?? ''}}" />
                @error('nama')
                   <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
	      <div class="mt-3">
               	<a class="btn btn-sm btn-secondary" href="{{route('dashboard.categories')}}">Cancel</a>
		<button type="submit" class="btn btn-success btn-sm">{{$button}}</button>
              </div>
          </form>
        </div>
      </div>
   </div>
</div>

<!-- Delete --!>
@if(isset($category))
<div class="modal fade" id="deleteModal">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
           <h5>Delete</h5>
           <button type="button" data-dismiss="modal">X</button>
        </div>

        <div class="modal-body">
           <p>Anda yakin ingin menghapus Category {{$category->nama}}</p>
        </div>

        <div class="modal-footer">
           <form action="{{route('dashboard.categories.delete', $category->id '' ??)}}" method="post">
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
