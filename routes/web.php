<?php

use App\Http\Controllers\Charity\CharityController;
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
    return view('welcome');
});

// Route::get('/charity/dashboard', function () {
//     return view('charity.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

# Charity Group Controller
Route::controller(CharityController::class)->group(function () {
    Route::prefix('/charity')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', 'showDashboard')->name('dashboard');
        Route::get('/logout', 'destroy')->name('user.logout');
    });
});

require __DIR__ . '/auth.php';
