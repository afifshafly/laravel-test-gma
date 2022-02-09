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
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::group(['middleware' => 'auth:api','toko','verified'], function(){
        Route::get('/user', [TokoController::class, 'getUser'])->name('get.user');
    });
    Route::post('/password/forgot-password', [ForgotPasswordController::class, 'sendResetLinkResponse'])->name('passwords.sent');
    Route::post('/password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('passwords.resets');
    Route::get('email/verify/{id}', [VerificationApiController::class, 'verify'])->name('verificationapi.verify');
    Route::get('email/resend', [VerificationApiController::class, 'resend'])->name('verificationapi.resend');
});



