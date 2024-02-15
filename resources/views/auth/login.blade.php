@extends('layouts.auth.mainlayout')

@section('title', 'Login')

@section('content')

<div class="d-flex justify-content-center"> 
  <a  href="" class="btn-primary" data-toggle="modal" data-target="#jadwalModal">Jadwal waktu sholat &#9660</a>
</div>

<div class="container d-flex justify-content-center">
  <div class="card col-md-5 mt-5">
    <div class="card-header">
      <h5>Login</h5>
    </div>
    <div class="card-body m-2">
      @if(session('status'))
        <span class="text-danger"><b>{{session('message')}}</b></span>
	@endif

      <form action="" method="post">
      @csrf
      	<div class="input-group mt-3">
	  <span class="input-group-text material-symbols-outlined">person</span>
	  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Email" required />
	</div>

        <div class="input-group mt-3">
          <span class="input-group-text material-symbols-outlined">lock_person</span>
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPass" placeholder="Password" required />     
          <span class="input-group-text material-symbols-outlined" id="viewPass" onClick="myPass()" style="cursor: pointer">visibility</span>
	  @error('password')
	    <strong class="invalid-feedback mx-3">{{$message}}</strong>
	  @enderror
        </div>

      	<div class="input-group row mb-3">
	  <a href="{{route('password.request')}}" style="text-align: center;">Lupa password ?</a>
      	</div>
       	<div class="row mx-1">
          <button type="submit" class="btn" style="background-color: #ced4da;">Login</button>
      	</div>
      	<div class="mt-3">
          <label>Login menggunakan Barcode ?</label>
          <a href="{{route('login.scan')}}">Klik disini </a>
      	</div>
      	<div>
          <label>Anda tidak mempunyai Akun ?</label>
          <a href="/register">Registrasi disini</a>
      	</div>
      </form>
    </div>
  </div>
</div>

<div class="fade modal" id="jadwalModal">
  <div class="modal-dialog" style="width: 21em;">
    <div class="modal-content">
      <div id="headerJadwal" class="modal-header bg-primary">
  
      </div>

      <div id="bodyJadwal" class="modal-body">
	<span id="tanggal"></span>	  
	<span id="jam"></span>	  
      </div>

      <div id="footerJadwal" class="modal-footer">
	  
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/jadwalSholat.js')}}"></script>
<script src="{{ asset('js/clock.js')}}"></script>
<script src="{{ asset('js/helper.js')}}"></script>

