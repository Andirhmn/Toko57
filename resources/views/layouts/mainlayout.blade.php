<!doctype html>
<html lang="en">
<head>
  
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>TOKO 57 | @yield('title')</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

   <link rel="stylesheet" href="{{asset('css/mainlayout.css')}}" />
</head>

<body> 
   <div class="main d-flex flex-column justify-content-between">
      <nav class="navbar navbar-dark navbar-expand-lg" style="background: #ced4da;">
	<div class="container">

	  <a class="navbar-brand text-dark" href="{{route('dashboard')}}"><h4>TOKO 57</h4></a>
	  <div class="dropdown">
            <a class="text-dark btn dropdown-toggle" href="" type="button" data-toggle="dropdown" aria-expanded="false">
              {{Auth::user()->username}}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item logout" href="{{route('logout')}}">Logout</a></li>
	    </ul>
	  </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
           aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"</span>
	  </button>
      </nav>

      <div class="body-content h-100">
        <div class="row h-100">
           <div class="sidebar col-lg-2 collapse d-lg-block" id="navbarTogglerDemo03">
                  <a href="{{route('dashboard')}}" @if(request()->route()->uri == 'dashboard') class='active' @endif >Dashboard</a>
		  <a href="{{route('dashboard.transactions')}}" 
			@if(request()->route()->uri == 'dashboard/transactions' || 
			request()->route()->uri == 'dashboard/transactions/create') class='active' @endif >Transaksi
		  </a>
		  <a href="{{route('dashboard.items')}}" 
			@if(request()->route()->uri == 'dashboard/items' ||
			request()->route()->uri == 'dashboard/items/create' || 
			request()->route()->uri == 'dashboard/items/{item}') class='active' @endif >Produk
		  </a>
		  <a href="{{route('dashboard.categories')}}" 
			@if(request()->route()->uri == 'dashboard/categories' || 
			request()->route()->uri == 'dashboard/categories/create' ||
			request()->route()->uri == 'dashboard/categories/{category}') class='active' @endif >Kategori
		  </a> 
                  <a href="{{route('dashboard.users')}}" @if(request()->route()->uri == 'dashboard/users') class='active' @endif >Users</a>
           </div>
           <div class="content col-lg-10">
                @yield('content')
		@yield('js')
           </div>
        </div>
      </div>
   </div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" 
 integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" 
 integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

</html>
