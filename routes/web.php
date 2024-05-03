<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DevController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ViewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ptest', function () {
    return view('welcome');
});

Route::get('/api/add-data/{id}/{air}/{soil}/{temp}/{shower}', [ViewController::class, 'addData'])->name('addDataApi');
Route::get('/pending', [ViewController::class, 'pending'])->name('pending');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/welcome', [AuthController::class, 'welcome'])->name('welcome');

Route::name('google.')->group(function () {
    Route::get('auth/google/redirect', [AuthController::class, 'googleRedirect'])->name('redirect');
    Route::get('auth/google/callback', [AuthController::class, 'googleCallback'])->name('callback');
});

Route::middleware('AuthenticateAcc')->group(function () {
    Route::get('/', [ViewController::class, 'index'])->name('home');
    Route::post('/api/get-data', [APIController::class, 'allIndex'])->name('getDataApi');
    Route::resource('/plant', PlantController::class)->missing(function (Request $request) {
        return redirect()->route('home')->with('error', 'Wrong Parameter');
    });
});


// ROUTE DEV || MATIKAN ROUTE INI SAAT DI PRODUCTION
Route::get('direct-login', [DevController::class, 'directLogin']);