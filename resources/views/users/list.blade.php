@extends('layouts.mainlayout')

@section('title', 'Users')

@section('content')

@if(session()->has('status'))
   <div class="alert alert-success">
      <strong>{{session()->get('status')}}</strong>
   </div>
@endif

<div class="card">
   <div class="card-header">
      <div class="row">
        <div class="col-lg-8">
           <h4>Users</h4>
        </div>

        <div class="col-lg-4 search">
           <form method="get" action="">
              <div class="input-group justify-content-end">
                <input type="text" class="form-control" name="q" value="{{$request['q'] ?? ''}}" />
                <button type="submit" class="btn btn-secondary btn-sm">Search</button> 
              </div>
           </form>
	</div>
      </div>
   </div>

   <div class="card-body p-2">
   <div class="table-responsive">
      <table class="table">
   @if($users->total())
	<tr>
           <th>User</th>
           <th>Email</th>
           <th>Status</th>
           <th>Last seen</th>
           <th>Created at</th>
	   @if(Auth::user()->role_id == 1)
	   <th>Action</th>
	   @endif
        </tr>
	@foreach($users AS $user)
	@php
	  $status = $user->last_seen >= now()->subMinutes(2) ? 'Online' : 'Offline';
	  $last_seen = Carbon\Carbon::parse($user->last_seen)->diffForHumans();
	@endphp
	<tr>
           <td class="col-title">{{$user->username}}</td>
           <td class="col-title">{{$user->email}}</td>
           <td class="col-title" @if($user->status == 'active') ? style='color: green;' @else style='color: red;' @endif >{{$user->status}}</td>
           <td class="col-title" @if($status == 'Online') ? style='color: green;' @else style='color: red;' @endif >{{$status}} | {{$last_seen}}</td>
	   <td class="col-title">{{$user->created_at}}</td>
	   @if(Auth::user()->role_id == 1)
	   <td><a class="col-title btn btn-sm btn-primary" data-toggle="modal" data-target="#statusModal" href="">Change Status</a></td>
	   @endif
	</tr> 
        @endforeach
      </table>

   {{ $users->appends($request)->links() }}
   @else
        <h4 class="text-center">Data tidak ditemukan<h4>
   @endif
   </div>
   </div>
</div>

<div class="modal fade" id="statusModal">
   <div class="modal-dialog">
      <div class="modal-content">
	<div class="modal-header">
	   <h4>Change Status<h4>
	   <button class="btn" data-dismiss="modal">X</button>
	</div>
	<form method="post" action="{{route('dashboard.users.update', $user->id ?? '')}}">
	@csrf
	   <div class="modal-body">
	      <div class="form-check">
	        <input class="form-check-input" type="radio" name="status" />
	   	<label for="status" class="form-check-label">Active</label>
	      </div>
	      <div class="form-check">
	        <input class="form-check-input" type="radio" name="status" />
	   	<label for="status" class="form-check-label">Inactive</label>
	      </div>
	   </div>
	   <div class="modal-footer">
	      <button class="btn btn-primary" type="submit">Save</button>
	   </div>
	</form>
      </div>
   </div>
</div>

@endsection
