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
    Route::get('/leads/9a7445e2-07eb-11ed-861d-0242ac120002', function () {
        return view('charity.donors.leads.view');
    })->name('leads.view');
    // Route::get('/leads/delete/1', deleteLead)->name('leads.delete');

    # Prospects
    Route::get('/prospects', function () {
        return view('charity.donors.prospects.all');
    })->name('prospects.all');
    Route::get('/prospects/93e5c76a-2316-46e4-b24f-b33131100457', function () {
        return view('charity.donors.prospects.view');
    })->name('prospects.view');
    // Route::get('/prospects/move/1', moveLead)->name('prospects.move');
});
// });

# Our Charitable Organization Controller
// Route::controller(DonorController::class)->group(function() {
Route::prefix('/our-charity')->middleware(['auth', 'verified'])->group(function () {

    # Public Profile
    Route::get('/profile', function () {
        return view('charity.main.profile.index');
    })->name('charity.profile');
    Route::get('/profile/setup', function () {
        return view('charity.main.profile.setup');
    })->name('charity.profile.setup');
    Route::get('/profile/apply-for-verification', function () {
        return view('charity.main.profile.verify');
    })->name('charity.profile.verify');

    # Projects



    # Users



    # Beneficiaries
    Route::get('/beneficiaries', function () {
        return view('charity.main.beneficiaries.all');
    })->name('charity.beneficiaries');
    Route::get('/beneficiaries/add', function () {
        return view('charity.main.beneficiaries.add');
    })->name('charity.beneficiaries.add');
    Route::get('/beneficiaries/69a60048-d093-41d7-bf58-d620ec99c979', function () {
        return view('charity.main.beneficiaries.view');
    })->name('charity.beneficiaries.view');
    Route::get('/beneficiaries/edit/69a60048-d093-41d7-bf58-d620ec99c979', function () {
        return view('charity.main.beneficiaries.edit');
    })->name('charity.beneficiaries.edit');
    Route::post('/beneficiaries/save/69a60048-d093-41d7-bf58-d620ec99c979', function () {
    })->name('charity.beneficiaries.update');


    # Benefactors
    Route::get('/benefactors', function () {
        return view('charity.main.benefactors.all');
    })->name('charity.benefactors');
    Route::get('/benefactors/add', function () {
        return view('charity.main.benefactors.add');
    })->name('charity.benefactors.add');
    Route::get('/benefactors/6e4a560c-1252-11ed-861d-0242ac120002', function () {
        return view('charity.main.benefactors.view');
    })->name('charity.benefactors.view');
    Route::get('/benefactors/edit/6e4a560c-1252-11ed-861d-0242ac120002', function () {
        return view('charity.main.benefactors.edit');
    })->name('charity.benefactors.edit');


    # Volunteers

});
// });

require __DIR__ . '/auth.php';
