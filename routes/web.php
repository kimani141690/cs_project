<?php

use App\Http\Controllers\AuthenticationController;
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

Route::get('/', [Routing:: class, 'showIndex'])->name('/');

Route::prefix('auth')->group(function () {
    //get routes (to view the files)
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('reset', [AuthController::class, 'PasswordReset']);
    Route::get('customer-reg', [AuthController::class, 'registrationTypes']);
    Route::get('farmer-reg', [AuthController::class, 'registrationTypes']);
    Route::get('verify-email/{token}', [AuthController::class, 'verifyEmail']);
    Route::get('logout', [AuthController::class, 'logout']);




    //post routes
    Route::post('/registration', [AuthController::class, 'registration']);
    Route::post('/processLogin', [AuthController::class, 'processLogin']);
    Route::post('/passwordupdate', [AuthController::class, 'processLogin']);




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
Route::prefix('google')->name('google.')->group( function(){
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});
