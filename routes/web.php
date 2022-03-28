<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Auth::routes();


Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::post('add-customer', [CustomerController::class, 'store'])->name('post.customer');
    Route::post('edit-customer', [CustomerController::class, 'edit'])->name('edit.customer');
    Route::post('delete-customer', [CustomerController::class, 'destroy'])->name('delete.customer');

    Route::get('customer-search', [CustomerController::class, 'search'])->name('search.customer');
    Route::get('customer-sortir', [CustomerController::class, 'sortir'])->name('sortir.customer');
});
