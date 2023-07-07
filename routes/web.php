<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Routing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::group(['middleware' => 'disable_back'], function () {


    Route::get('/', [Routing:: class, 'showIndex'])->name('/');

    Route::prefix('auth')->group(function () {
        //get routes (to view the files)
        //login and registration
        Route::get('login', [Routing::class, 'accounts'])->name('login');
        Route::get('customer-reg', [Routing::class, 'accounts'])->name('customer');
        Route::get('farmer-reg', [Routing::class, 'accounts'])->name('farmer');

        //password resets and verification
        Route::get('reset', [Routing::class, 'accounts']);
        Route::get('registration/{token}', [Routing::class, 'fromMailResetRequest'])->name('create_reset');
        Route::get('request-reset/{token}',[Routing::class,'fromMailResetRequest'])->name('request_reset');

        //post routes
        Route::post('login', [AuthController::class, 'processLogin']);
        Route::post('registration', [AuthController::class, 'registration']);
        Route::post('request-reset',[AuthController::class,'sendPasswordRequestMail']);
        Route::post('reset-password', [AuthController::class, 'passwordResetAction']);

        Route::get('logout', [AuthController::class, 'logout']);
    });
//------------------------------------------------------------------------------------------------------------
//customer routes

    Route::prefix('customer')->group(function () {
        //get routes (to view the files)
        Route::get('index', [CustomerController::class, 'showindex'])->name('login');


    });

//------------------------------------------------------------------------------------------------------------
//Farmers routes

    Route::prefix('farmer')->group(function () {
        //get routes (to view the files)
        Route::get('index', [FarmerController::class, 'showindex'])->name('login');


    });
//-------------------------------
// Google URL
    Route::prefix('google')->name('google.')->group(function () {
        Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
        Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
    });


});
