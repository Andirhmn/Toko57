@extends('layouts.auth.mainlayout')

@section('title', 'Reset Password')

@section('content')

<div class="container d-flex justify-content-center">
  <div class="card col-md-6 mt-5">
    <div class="card-header">
      <h5>Reset Password</h5>
    </div>
    <div class="card-body m-2">

      <h6 class="mb-3">Silahkan masukkan Password baru Anda</h6>

      <form action="{{route('password.update')}}" method="post">
      @csrf
        <input type="hidden" name="token" value="{{request()->token}}" />
	<input type="hidden" name="email" value="{{request()->email}}" />

	<div class="row mb-3">
	  <label for="password" class="col-form-label col-md-4">Password Baru</label>
	  <div class="col-md-7">
            <input type="password" name="password" class="@error('password') is-invalid @enderror form-control" required />
       	    @if($errors->any())
	      @foreach($errors->all() as $error)
	  	<strong class="invalid-feedback">{{$error}}</strong>
	      @endforeach
      	    @endif
	  </div>
	</div>
	<div class="row mb-3">
	  <label for="password_confirmation" class="col-form-label col-md-4">Konfirmasi Password</label>
	  <div class="col-md-7">
            <input type="password" name="password_confirmation" class="form-control" required />
	  </div>
	</div>

	<div class="row mx-4">
          <button type="submit" class="btn" style="background-color: #ced4da;">Reset Password</button>
	</div>
      </form>

    </div>  
  </div>
</div>

<script src="{{asset('js/helper.js')}}"></script>
@endsection
