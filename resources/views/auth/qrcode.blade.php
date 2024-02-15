@extends('layouts.auth.mainlayout')

@section('title', 'Login Barcode')

@section('content')

<div class="contaienr d-flex justify-content-center">
  <div class="card col-md-4 mt-5">
    <div class="card-body">
      <label class="form-label mb-3">Silahkan Scan Barcode anda untuk Login</label>
      <div id="reader" style="">
	<input type="hidden" name="login" class="login" />
      </div>
      <div>
 	<label class="mt-3 form-label">Login menggunakan Email ?</label>
	<a href="{{route('login')}}">Klik disini</a> 
      </div>
    </div>
  </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
  // console.log(`Code matched = ${decodedText}`, decodedResult);

  $('.login').val(decodedText)
  let id = decodedText;
//  CSRF_TOKEN = $('meta[name="csrf_token"]').attr('content')
    $.ajax({
      method: "post",
      url: "{{route('login.scan')}}",
      data: {
//        _method: "get",
        _token: "{{csrf_token()}}",
        qr_code: id
      },
        success: function(data) {
          if(data == 2) {
            alert('Login berhasil')
            window.location.reload()
          } else if(data == 1) {
            alert('Login gagal | Akun anda belum aktif')
            window.location.reload()
          } else {
            alert('Login gagal')
            window.location.reload()
          }
        }
    });
}

function onScanFailure(error) {
//  console.warn(`Code scan error = ${error}`);
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  {fps: 10, qrbox: {width: 175, height: 175} },
  /* verbose= */ false);
  html5QrcodeScanner.render(onScanSuccess, onScanFailure); 
</script>

