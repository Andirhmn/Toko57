@extends('layouts.mainlayout')

@section('title', 'Transactions')

@section('content')
  <div class="card-body">
    <div class="row">
	<div class="col-lg-8">
	  <div class="form-group">
	    <label class="fw-bold p-2" for="id_daftar">DAFTAR BARANG</label>
	  </div>
	</div>
    </div>

    <div class="row">
    <?php
      function rupiah($angka) {
      	$hasil_rupiah = "Rp ".number_format($angka);
	return $hasil_rupiah;
      }
      function bayar($angka) {
 	  $hasil_rupiah = number_format($angka);
	  return $hasil_rupiah;
      }
    ?>
	<div class="col-lg-8 table-responsive">
	  <table class="table table-hover table-bordered">
	    <thead>
		<tr>
                  <th>Nama Barang</th>
                  <th class="w-25">Quantity</th>
                  <th>Harga</th>
                  <th>Total</th>
                  <th>Aksi</th>
	      	</tr>
	    </thead>
	<?php
	$subtotal = 0;
	$bayar = session('bayar');
	?>
	@foreach($keranjang as $key => $value)
	<?php
	$barang_id = $key;
	$nama_barang = $value['nama'];
	$quantity = $value['quantity'];
	$harga = $value['harga_satuan'];
	$total = $harga * $quantity;
	$subtotal = $subtotal + $total;
	$kembali = $bayar - $subtotal;
	?>
	    <tr>
		<td>{{$nama_barang}}</td>
		<td><input  onChange="window.location.reload()" type="text" name={{$barang_id}} value="{{$quantity}}" class="w-50 update-quantity" /></td>
		<td>{{rupiah($harga)}}</td>
		<td>{{rupiah($total)}}</td>
		<td><button name="{{$barang_id}}" class="remove-keranjang">Hapus</button></td>
	    <tr>
	@endforeach
	   </table>
	<div class="row">
	  <div class="col-md-8">
	    <td><b>Total Beli</b></td>
	  </div>
	  <div class="col-md-4">
            <td><b>{{rupiah($subtotal)}}</b></td>
	  </div>
	</div>

	<div class="mt-2 row">
	  <div class="col-md-8">
	    <td><b>Bayar</b></td>
	  </div>
	  <div class="col-md-4">
	    <td>
		<label style="padding-right: 1px;">Rp</label>
		<input onChange="window.location.reload()" type="text" class="pembayaran"  value="{{bayar($bayar)}}" style="width: 125px;" />
	    </td>
	  </div>
	</div>

	<div class="mt-2 row">
	  <div class="col-md-8">
	    <td><b>Kembali</b></td>
	  </div>
	  <div class="col-md-4">
            <td><b>{{rupiah($kembali)}}</b></td>
	  </div>
	</div>

	   <div class="row">
	      <div class="col-md-10">
		<a></a>
	      </div>
	      <div class="col-md-2" style="padding-left: 55px;">
	        <a href="{{route('dashboard.transactions.destroySession')}}" class="btn btn-secondary btn-sm" onClick="return confirm('Hapus semua ?')">Clear</a>
	      </div>
	   </div>
        </div>
     </div>
   </div>

@endsection

@section('js')

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
//var rupiah = document.getElementById("pembayaran");

//rupiah.addEventListener("keyup", function(e) {
//  rupiah.value = formatRupiah(this.value, "Rp")
//});

//function formatRupiah(angka, prefix) {
//  var number_string = angka.replace(/[^,\d]/g,"").toString(),
//      split 	    = number_string.split("."),
//      sisa 	    = split[0].length % 3,
//      rupiah 	    = split[0].substr(0, sisa),
//      ribuan  	    = split[0].substr(sisa).match(/\d{3}/gi);
//}
</script>

<script>
$(".update-quantity").on("input", function(e) {
  var barang_id = $(this).attr("name"); 
  var value = $(this).val();  
//console.log(value)
  $.ajax({
        method: "patch",
        url: "{{route('dashboard.transactions.updateQuantity')}}",
        data: {
          _token: "{{csrf_token()}}",
          id: barang_id,
          quantity: value
        },
        success: function(response) {
//          window.location.reload();
        }
  })
});

$(".remove-keranjang").click(function(e) {
  e.preventDefault();
  var barang_id = $(this).attr("name");

  if(confirm("Apakah anda yakin ingin menghapusnya")) {
    $.ajax({
  	method: "delete",
	url: "{{route('dashboard.transactions.delete')}}",
	data: {
	  _token: "{{csrf_token()}}",
	  id: barang_id
  	},
	success: function(response) {
          window.location.reload();
	}
    });
  }
});

$(".pembayaran").on("input", function(e) {
  var value = $(this).val();
    $.ajax({
      method: "get",
      url: "{{route('dashboard.transactions.updateBayar')}}",
      data: {
  	_token: "{{csrf_token()}}",
	pembayaran: value
    },
      success: function(data) {
      }
    });
});
</script>

@endsection
