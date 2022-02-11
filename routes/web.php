<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\SupplierController;

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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('admin');
Route::get('/toko', [TokoController::class, 'index'])->name('toko')->middleware('toko');

Auth::routes();


Route::group(['middleware' => ['auth','supplier','verified']],function(){

    Route::group(['prefix' => 'supplier'], function () {

        Route::get('/', [SupplierController::class, 'dashboard'])->name('supplier.dashboard');
        //produk
        Route::group(['prefix' => 'produk'], function () {
            route::get('/', [SupplierController::class, 'indexProduk'])->name('produk.index');
            route::post('/store', [SupplierController::class, 'storeProduk'])->name('produk.store');
            route::get('/getproduk', [SupplierController::class, 'getProduk'])->name('produk.get');
            route::get('/edit/{id}', [SupplierController::class, 'editProduk'])->name('produk.edit');
            route::delete('/delete/{id}', [SupplierController::class, 'destroyProduk'])->name('produk.delete');
        });

        Route::group(['prefix' => 'order'], function () {
            route::get('/', [SupplierController::class, 'indexOrder'])->name('order.index');
            route::get('/getorder', [SupplierController::class, 'getOrder'])->name('get.order');
            route::get('/approve/{id}', [SupplierController::class, 'approve'])->name('approve.order');
            // route::get('/getorderdetail/{order_id}', [SupplierController::class, 'getOrderdetail'])->name('get.order.detail');
        });

	});

});


//Argon
Route::group(['middleware' => 'auth'], function () {

	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade');
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons');
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

