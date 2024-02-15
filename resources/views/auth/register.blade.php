@extends('layouts.auth.mainlayout')

@section('title', 'Register')

@section('content')

<div class="container d-flex justify-content-center">
  <div class="card col-md-6 mt-5">
    <div class="card-header">
      <h5>Register</h5>
    </div>
    <div class="card-body m-2">
      <form action="" method="post">
      @csrf
	<div class="row mb-3">
	  <label for="username" class="col-form-label col-md-4">Username</label>
	  <div class="col-md-8">
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}" />
            @error('username')
              <strong class="invalid-feedback">{{$message}}</strong>
            @enderror 
	  </div>
 	</div>
	<div class="row mb-3">
	  <label for="email" class="col-form-label col-md-4">Email</label>
	  <div class="col-md-8">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" />
            @error('email')
              <strong class="invalid-feedback">{{$message}}</strong>
            @enderror 
	  </div>
 	</div>
	<div class="row mb-3">
	  <label for="password" class="col-form-label col-md-4">Password</label>
	  <div class="col-md-8">
	    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPass" />
            @error('password')
              <strong class="invalid-feedback">{{$message}}</strong>
            @enderror 
	  </div>
 	</div>
	<div class="row mb-3">
	  <label for="password_confirmation" class="col-form-label col-md-4">Konfirmasi Password</label>
	  <div class="col-md-8">
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" />
            @error('password_confirmation')
              <strong class="invalid-feedback">{{$message}}</strong>
            @enderror 
	  </div>
	</div>

        <div class="row mx-1">
          <button type="submit" class="btn" style="background-color: #ced4da;">Register</button>
        </div>
	<div class="mt-3">
          <label>Anda sudah punya Akun ?</label>
          <a href="{{route('login')}}">Login disini</a>
        </div>
      </form>

    </div>  
  </div>
</div>

<script src="{{asset('js/helper.js')}}"></script>
@endsection
