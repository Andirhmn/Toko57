@extends('layouts.auth.mainlayout')

@section('title', 'Forgot Password')

@section('content')

<div class="container d-flex justify-content-center">
  <div class="card col-md-6 mt-5">
    <div class="card-header">
      <h5>Lupa Kata Sandi</h5>
    </div>
    <div class="card-body m-2">

      <h6>Lupa kata sandi Anda ?</h6>
      <p>Silahkan masukkan Email anda untuk menerima link reset kata sandi</p>

      <form action="" method="post">
      @csrf
	<div class="row mb-3">
	  <label for="email" class="col-form-label col-md-3">Email</label>
	  <div class="col-md-8">
	    <input type="email" 
		   name="email" 
		   class="form-control
			  @if(session()->has('status')) is-valid @endif
			  @error('email') is-invalid @enderror"
		   value="{{old('email')}}"
	    />
      	    @if(session()->has('status'))
	      <strong class="valid-feedback">{{session()->get('status')}}</strong>
            @endif
	    @if($errors->any())
	      @foreach($errors->all() as $error)
	    	<strong class="invalid-feedback">{{$error}}</strong>
	      @endforeach
	    @endif
	  </div>
	</div>

	<div class="mx-4">
          <div class="row mb-2">
            <button type="submit" class="btn" style="background-color: #ced4da;">Reset Password</button>
          </div>
          <div class="row">
            <a href="{{route('login')}}" class="btn" style="background-color: #ced4da;">Kembali ke Halaman Login</a>
          </div>
	</div>
      </form>

    </div>  
  </div>
</div>

<script src="{{asset('js/helper.js')}}"></script>
@endsection
