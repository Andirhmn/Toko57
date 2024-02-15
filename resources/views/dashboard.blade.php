@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('content')
<div class="row">
   <div class="col-lg-2">
      <h5>Welcome, {{Auth::user()->username}}</h5>
   </div>

   <div class="col-lg-6">
      <h5 class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#barcodeModal">Lihat Barcode</h5>
   </div>

   <div class="col-lg-4 search">
      <form method="get" action="{{route('dashboard')}}">
      	<div class="input-group justify-content-end">
	   <input type="text" class="form-control" name="q" value="{{$request['q'] ?? ''}}" />
           <button class="btn btn-secondary btn-sm" type="submit">Search</button>
	</div>
      </form>
   </div>
</div>

   <div class="mt-3 row">

      <div class="col-lg-4">
        <div class="card-data items">
           <div class="row">
              <div class="col-6"><i class="bi bi-bag-check"></i></div>
              <div class="col-6 d-flex flex-column justify-content-center">
                <a href="{{route('dashboard.items')}}" class="card-desc">Items</a>
                <div class="card-count">{{$items}}</div>
              </div>
           </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card-data categories">
           <div class="row">
              <div class="col-6"><i class="bi bi-card-list"></i></div>
              <div class="col-6 d-flex flex-column justify-content-center">
                <a href="{{route('dashboard.categories')}}" class="card-desc">Categories</a>
                <div class="card-count">{{$categories}}</div>
	      </div>
           </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card-data users">
           <div class="row">
              <div class="col-6"><i class="bi bi-people-fill"></i></div>
              <div class="col-6 d-flex flex-column justify-content-center">
                <a href="{{route('dashboard.users')}}" class="card-desc">Users</a>
                <div class="card-count">{{$users}}</div>
              </div>
           </div>
        </div>
      </div>

   </div>

   <div class="mt-2">
      <h5>#Log Activity</h5>
	<table class="table">
	   <thead>
              <tr class="">
                <td><strong>No</strong></td>
                <td><strong>User</strong></td>
                <td><strong>Log Aktivitas</strong></td>
                <td><strong>Waktu Aktivitas</strong></td>
	      </tr>
	   </thead>
	   <tbody>
	   @foreach($logs AS $key => $log)
	      <tr>
		<td>{{($logs->currentPage() - 1) * $logs->perPage() + $loop->iteration}}</td>
		<td>{{$log->user_id}}</td>
		<td>{{$log->extra}}</td>
		<td>{{$log->created_at}}</td>
	      </tr>
	   @endforeach
	   </tbody>
	{{$logs->appends($request)->links()}}
        </table>
   </div>

<div class="fade modal" id="barcodeModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-bg-primary">
	<h5>Barcode Anda</h5>
	<button type="button" data-dismiss="modal">X</button>
      </div>

      <div class="modal-body" style="padding-left: 10em;">
	{!! DNS2D::getBarcodeHTML(Auth::user()->password, 'QRCODE', 5, 5) !!}
      </div>
    </div>
  </div>
</div>
@endsection

