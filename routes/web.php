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

    # Dashboard
    Route::prefix('/charity')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', 'showDashboard')->name('dashboard');
    });
    # User Profile
    Route::prefix('/profile')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', 'showProfile')->name('user.profile');
        Route::get('/edit', 'editProfile')->name('user.profile.edit');
        Route::post('/store', 'storeProfile')->name('user.profile.store');
    });
    # Change Password
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/change-password', 'editPassword')->name('user.password.change');
        Route::post('/store-password', 'storePassword')->name('user.password.store');
    });
    # Logout
    Route::get('/user/logout', 'destroy')->name('user.logout');
});

# Donors and Donations Group Controller
// Route::controller(DonorController::class)->group(function() {
Route::prefix('/donors')->middleware(['auth', 'verified'])->group(function () {

    # Leads
    Route::get('/leads', function () {
        return view('charity.donors.leads.all');
    })->name('leads.all');
    Route::get('/leads/view/1', function () {
        return view('charity.donors.leads.view');
    })->name('leads.view');
});
// });

require __DIR__ . '/auth.php';
