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
Route::controller(CharityController::class)->middleware(['auth', 'verified', 'prevent-back-history'])->group(function () {

    # Dashboard
    Route::prefix('/charity')->group(function () {
        Route::get('/dashboard', 'showDashboard')->name('dashboard');
    });
    # User Profile
    Route::prefix('/profile')->group(function () {
        Route::get('/', 'showProfile')->name('user.profile');
        Route::get('/edit', 'editProfile')->name('user.profile.edit');
        Route::post('/store', 'storeProfile')->name('user.profile.store');
    });
    # Change Password
    Route::prefix('/password')->group(function () {
        Route::get('/change', 'editPassword')->name('user.password.change');
        Route::post('/store', 'storePassword')->name('user.password.store');
    });
    # Logout
    Route::get('/user/logout', 'destroy')->name('user.logout');
});


# Charity Users Group
Route::middleware(['auth', 'verified', 'prevent-back-history'])->group(function () {

    Route::prefix('/charity')->group(function () {
        # Donors and Donations Group Controller
        // Route::controller(DonorController::class)->group(function() {
        Route::prefix('/donors-and-donations')->group(function () {

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
        // Route::controller(OurCharityOrgController::class)->group(function() {
        Route::name('charity.')->prefix('/our-charitable-org')->group(function () {

            # Public Profile - Only Charity Admins can access the ff:
            Route::name('profile')->prefix('/profile')->middleware(['charity.admin'])->group(function () {
                Route::get('', function () {
                    return view('charity.main.profile.index');
                });
                Route::get('/setup', function () {
                    return view('charity.main.profile.setup');
                })->name('.setup');
                Route::get('/apply-for-verification', function () {
                    return view('charity.main.profile.verify');
                })->name('.verify');
            });

            # Projects
            Route::name('projects')->prefix('/projects')->group(function () {
                Route::get('', function () {
                    return view('charity.main.projects.all');
                });
                Route::get('/1a2267d9-3f39-4ef7-b6aa-5884f6b8e606', function () {
                    return view('charity.main.projects.view');
                })->name('.view');

                # Charity Admin only
                Route::middleware('charity.admin')->group(function () {
                    Route::get('/add', function () {
                        return view('charity.main.projects.add');
                    })->name('.add');
                    Route::get('/edit/1a2267d9-3f39-4ef7-b6aa-5884f6b8e606', function () {
                        return view('charity.main.projects.edit');
                    })->name('.edit');
                    Route::get('/featured/new/1a2267d9-3f39-4ef7-b6aa-5884f6b8e606', function () { // Add middleware that star tokens must be sufficient
                        return view('charity.main.projects.featured.add');
                    })->name('.feature');
                });

                # Tasks
                Route::name('.tasks')->prefix('/tasks')->group(function () {
                    Route::get('/c6e9df80-22c6-4829-a2f1-bad342699e7b', function () {
                        return view('charity.main.projects.tasks.view');
                    })->name('.view');
                });
                // Add Task
                // Edit Task (Assigned_to Only)
                // Delete Task (Charity admin / Assigned_by Only)
            });


            # Users
            Route::name('users')->prefix('/users')->group(function () {
                Route::get('', function () {
                    return view('charity.main.users.all');
                });
                Route::middleware(['charity.admin'])->get('/add', function () {
                    return view('charity.main.users.add');
                })->name('.add');
                // To add - Route::get() for editing email address of pending accounts with Charity Admin access only.
                // To add - Route::get() for deleting pending user accounts permanently with Charity Admin access only.
                Route::get('/6a9ae42b-f01e-4b69-a074-7ec7933557fd', function () {
                    return view('charity.main.users.view');
                })->name('.view');
            });


            # Beneficiaries
            Route::name('beneficiaries')->prefix('/beneficiaries')->group(function () {
                Route::get('', function () {
                    return view('charity.main.beneficiaries.all');
                });
                Route::get('/add', function () {
                    return view('charity.main.beneficiaries.add');
                })->name('.add');
                Route::get('/69a60048-d093-41d7-bf58-d620ec99c979', function () {
                    return view('charity.main.beneficiaries.view');
                })->name('.view');
                Route::get('/edit/69a60048-d093-41d7-bf58-d620ec99c979', function () {
                    return view('charity.main.beneficiaries.edit');
                })->name('.edit');
                Route::post('/save/69a60048-d093-41d7-bf58-d620ec99c979', function () {
                })->name('.update');
                // To add - Route::get() for deleting individual beneficiary records.
            });


            # Benefactors
            Route::name('benefactors')->prefix('/benefactors')->group(function () {
                Route::get('', function () {
                    return view('charity.main.benefactors.all');
                });
                Route::get('/add', function () {
                    return view('charity.main.benefactors.add');
                })->name('.add');
                Route::get('/6e4a560c-1252-11ed-861d-0242ac120002', function () {
                    return view('charity.main.benefactors.view');
                })->name('.view');
                Route::get('/edit/6e4a560c-1252-11ed-861d-0242ac120002', function () {
                    return view('charity.main.benefactors.edit');
                })->name('.edit');
                // To add - Route::get() for deleting individual benefactor records.
            });


            # Volunteers
            Route::name('volunteers')->prefix('/volunteers')->group(function () {
                Route::get('', function () {
                    return view('charity.main.volunteers.all');
                });
                Route::get('/add', function () {
                    return view('charity.main.volunteers.add');
                })->name('.add');
                Route::get('/7ba0c587-d347-4bcf-9e0e-28ec06066fb0', function () {
                    return view('charity.main.volunteers.view');
                })->name('.view');
                Route::get('/edit/7ba0c587-d347-4bcf-9e0e-28ec06066fb0', function () {
                    return view('charity.main.volunteers.edit');
                })->name('.edit');
            });
        });
        // });

        # Gift Givings
        Route::name('gifts.')->prefix('/gift-givings')->group(function () {
            Route::get('/leads', function () {
                return view('charity.donors.leads.all');
            })->name('all');
        });
    });
});



require __DIR__ . '/auth.php';
