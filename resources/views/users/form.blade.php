

@extends('layouts.mainlayout')

@section('title', 'Users')

@section('content')
<div class="card">
   <div class="card-header">
      <div class="row">
        <div class="col-11">
           <h3>Users</h3>
	</div>
      </div>
   </div>
   
   <div class="card-body">
      <div class="row">
        <div class="col-md-8 offset-md-2">
	   <form action="{{route('dashboard.users.update', $user->id)}}" method="post">
	   @if(isset($category))
	   @method('put')
	   @endif
           @csrf
	      <div class="form-group">
                <label for="status" class="p-2 form label">Status</label>
                <span>
                   <input <?php if($user->status == 'active') {echo 'checked';} ?> class="form-input" type="radio" name="status" value="active" /> Active
                   <input <?php if($user->status == 'inactive') {echo 'checked';} ?> class="form-input" type="radio" name="status" value="inactive" /> Inactive
                </span>
              </div>

	      <div class="mt-3">
               	<button type="submit" class="btn btn-sm btn-secondary" onclick="window.history.back()">Cancel</button>
		<button type="submit" class="btn btn-success btn-sm">Update</button>
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
           <form action="{{route('dashboard.categories.delete', $category->id)}}" method="post">
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
