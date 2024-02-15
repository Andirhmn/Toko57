<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForgetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('auth');


Route::middleware('guest')->group(function() {
  Route::get('/', [LoginController::class, 'login'])->name('login');
  Route::get('login/scan', [LoginController::class, 'scan'])->name('login.scan');
  Route::get('register', [RegisterController::class, 'create']);

  //forgot-password
  Route::get('/forgot-password', [ForgetPasswordController::class, 'request'])->name('password.request');
  Route::post('/forgot-password', [ForgetPasswordController::class, 'requestProcess'])->name('password.email');
  Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'reset'])->name('password.reset');
  Route::post('/reset-password', [ForgetPasswordController::class, 'resetProcess'])->name('password.update');
});

Route::post('/', [LoginController::class, 'auth']);
Route::post('login/scan', [LoginController::class, 'qrcode']);
Route::post('register', [RegisterController::class, 'store']);

Route::middleware('auth')->group(function() {
  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::get('dashboard/transactions', [TransactionController::class, 'index'])->name('dashboard.transactions');
  Route::get('dashboard/transactions/addKeranjang/{item}', [TransactionController::class, 'addKeranjang'])->name('dashboard.transactions.addKeranjang');
  Route::get('dashboard/transactions/create', [TransactionController::class, 'create'])->name('dashboard.transactions.create');
  Route::patch('dashboard/transactions/updateQuantity', [TransactionController::class, 'updateQuantity'])->name('dashboard.transactions.updateQuantity');

  Route::delete('dashboard/transactions/delete', [TransactionController::class, 'destroy'])->name('dashboard.transactions.delete');
  Route::get('dashboard/transactions/remove', [TransactionController::class, 'destroySession'])->name('dashboard.transactions.destroySession');
  Route::get('dashboard/transactions/bayar', [TransactionController::class, 'updateBayar'])->name('dashboard.transactions.updateBayar');

  Route::get('dashboard/items', [ItemController::class, 'index'])->name('dashboard.items');
  Route::get('dashboard/items/create', [ItemController::class, 'create'])->name('dashboard.items.create');
  Route::post('dashboard/items/store', [ItemController::class, 'store'])->name('dashboard.items.store');
  Route::get('dashboard/items/{item}', [ItemController::class, 'edit'])->name('dashboard.items.edit');
  Route::put('dashboard/items/{item}', [ItemController::class, 'update'])->name('dashboard.items.update');
  Route::delete('dashboard/items/{item}', [ItemController::class, 'destroy'])->name('dashboard.items.delete');

  Route::get('dashboard/categories', [CategoryController::class, 'index'])->name('dashboard.categories');
  Route::get('dashboard/categories/create', [CategoryController::class, 'create'])->name('dashboard.categories.create');
  Route::post('dashboard/categories/store', [CategoryController::class, 'store'])->name('dashboard.categories.store');
  Route::get('dashboard/categories/{category}', [CategoryController::class, 'edit'])->name('dashboard.categories.edit');
  Route::put('dashboard/categories/{category}', [CategoryController::class, 'update'])->name('dashboard.categories.update');
  Route::delete('dashboard/categories/{category}', [CategoryController::class, 'destroy'])->name('dashboard.categories.delete');

  Route::get('dashboard/users', [UserController::class, 'index'])->name('dashboard.users');
  Route::get('dashboard/users/{id}', [UserController::class, 'edit'])->name('dashboard.users.edit');
  Route::post('dashboard/users/{id}', [UserController::class, 'update'])->name('dashboard.users.update');
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');
