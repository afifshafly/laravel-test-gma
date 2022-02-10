<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TokoController;
use App\Http\Controllers\Auth\VerificationApiController;
use App\Http\Controllers\Api\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::namespace('Api')->group(function(){
    //register toko
    Route::post('register', [AuthController::class, 'register']);
    //login toko
    Route::post('login', [AuthController::class, 'login']);
    //forgot password
    Route::post('/password/forgot-password', [ForgotPasswordController::class, 'sendResetLinkResponse'])->name('passwords.sent');
    Route::post('/password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('passwords.resets');
    //verify email
    Route::get('email/verify/{id}', [VerificationApiController::class, 'verify'])->name('verificationapi.verify');
    Route::get('email/resend', [VerificationApiController::class, 'resend'])->name('verificationapi.resend');


        Route::group(['middleware' => 'auth:api','toko','verified'], function(){

            Route::group(['prefix' => 'toko'], function () {
                //get semua supplier terdaftar
                Route::get('/get-supplier', [TokoController::class, 'getSupplier'])->name('get.supplier');
                // get produk dari salah satu supplier
                Route::get('/get-supplier-produk/{supplier_id}', [TokoController::class, 'getSupplierProduk'])->name('get.supplier.produk');
                // order produk
                Route::post('/order-produk/{produk_id}', [TokoController::class, 'orderProduk'])->name('order.produk');
                // get approve produk
                Route::get('/approve-produk', [TokoController::class, 'getApproveProduk'])->name('approve.produk');
            });

        });

});



