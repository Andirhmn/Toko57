@extends('layouts.mainlayout')

@section('title', 'Categories')

@section('content')
<div class="mb-2">
   <a href="{{route('dashboard.categories.create')}}" class="btn btn-primary-outline">+ Category</a>
</div>

@if(session()->has('message'))
<div class="alert alert-success">
   <strong>{{Auth::user()->nama}}</strong>
   <strong>{{session()->get('message')}}</strong>
</div>
@endif

<div class="card">
   <div class="card-header">
      <div class="row">
        <div class="col-lg-8">
           <h4>Categories</h4>
        </div>

        <div class="col-lg-4 search">
           <form method="get" action="">
              <div class="input-group justify-content-end">
                <input type="text" name="q" class="form-control" value="{{$request['q'] ?? ''}}" />
                <button type="submit" class="btn btn-secondary btn-sm">Search</button> 
              </div>
           </form>
	</div>
      </div>
   </div>
   
   <div class="card-body p-2">
   @if($categories->total())
   <div class="table-responsive">
      <table class="table">
	<tr>
	   <th>No</th>
           <th>Kategori Barang</th>
	   @if(Auth::user()->role_id == 1)
	   <th>Action</th>
	   @endif
        </tr>
      	@foreach($categories AS $category)
	<tr>
           <td class="col-title">{{($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration}}</td>
	   <td class="col-title">{{$category->nama}}</td>
	   @if(Auth::user()->role_id == 1)
	   <td><a href="{{route('dashboard.categories.edit', $category->id)}}" class="btn btn-sm btn-success">Edit</a>
	   @endif
	   </td> 
        </tr>
        @endforeach
      </table>

   {{ $categories->appends($request)->links() }}
   @else
        <h4 class="text-center p-3">Belum ada Kategori tersedia<h4>
   @endif

  </div>
  </div>
</div>

@endsection
