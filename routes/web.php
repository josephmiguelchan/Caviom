<?php

use App\Http\Controllers\Charity\CharityController;
use App\Http\Controllers\Charity\BeneficiaryController;
use App\Http\Controllers\Charity\Beneficiary2Controller;
use App\Http\Controllers\Charity\Beneficiary3Controller;
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
    # Notifications
    Route::prefix('/notifications')->group(function () {
        Route::get('/', 'showNotifications')->name('user.notifications.all');
        Route::get('/19caf827-1ba2-4a16-836a-d3d48643ca0a', 'viewNotification')->name('user.notifications.view');
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

            # Beneficiaries Part 1
            Route::name('beneficiaries')->prefix('/beneficiaries')->group(function () {

                # Retrieve All Beneficiaries of Charitable Organization
                Route::get('/', [BeneficiaryController::class, 'index'])->name('.all');

                # View A Specific Record from Beneficiaries
                Route::get('/view/{beneficiaries:code}', [BeneficiaryController::class, 'show'])->name('.show');

                # Create A Beneficiary Record
                Route::get('/create', [BeneficiaryController::class, 'create'])->name('.create');

                # About to Store the New Beneficiary Record
                Route::post('/store', [BeneficiaryController::class, 'store'])->name('.store');

                # Delete A Beneficiary Record
                Route::get('/delete/{beneficiaries:code}', [BeneficiaryController::class, 'delete'])->name('.delete');

                # Edit: Choose Which Part to Edit from Part1 - Part3
                Route::post('/editPart/{beneficiaries:code}', [BeneficiaryController::class, 'editPart'])
                    ->name('.editPart');

                # Edit: User chose part 1 to edit
                Route::get('/edit/{beneficiaries:code}', [BeneficiaryController::class, 'edit'])->name('.edit');

                # About to Update the Edit Beneficiary Record
                Route::post('/update/{beneficiary:code}', [BeneficiaryController::class, 'update'])->name('.update');
            });

            # Beneficiaries Part 2
            Route::name('beneficiaries2')->prefix('/beneficiaries')->group(function () {

                # Create A Family Info Record To A Beneficiary
                Route::get('/create-part2/{beneficiaries:code}', [Beneficiary2Controller::class, 'createPart2'])
                    ->name('.createPart2');

                # About to Store the New Family Info Record To A Beneficiary
                Route::post('/store-part2/{beneficiaries:code}', [Beneficiary2Controller::class, 'storePart2'])
                    ->name('.storePart2');

                # Delete A New Family Info Record From A Beneficiary
                Route::post('/destroy-part2/{id}/{beneficiary_code}', [Beneficiary2Controller::class, 'destroyPart2'])
                    ->name('.destroyPart2');

                # Retrieve the Family Info that is about to be edited
                Route::post('/update-part2/{id}/{beneficiary_code}', [Beneficiary2Controller::class, 'updatePart2'])
                    ->name('.updatePart2');

                # Edit: User chose part 2 to edit
                Route::get('/edit-part2/{beneficiaries:code}', [Beneficiary2Controller::class, 'editPart2'])
                    ->name('.editPart2');
            });

            # Beneficiaries Part 3
            Route::name('beneficiaries3')->prefix('/beneficiaries')->group(function () {

                # Create The Background Information To A Beneficiary
                Route::get('/create-part3/{beneficiaries:code}', [Beneficiary3Controller::class, 'createPart3'])
                    ->name('.createPart3');

                # About to Store the Background Information Record To A Beneficiary
                Route::post('/store-part3/{beneficiaries:code}', [Beneficiary3Controller::class, 'storePart3'])
                    ->name('.storePart3');

                # Edit: User chose part 3 to edit
                Route::get('/edit-part3/{beneficiaries:code}', [Beneficiary3Controller::class, 'editPart3'])
                    ->name('.editPart3');

                # About to Update the Edit Beneficiary Record
                Route::post('/update-part3/{beneficiary:code}', [Beneficiary3Controller::class, 'update'])->name('.update');
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
            Route::get('', function () {
                return view('charity.gifts.all');
            })->name('all');
            Route::get('/139e93ef-7823-406c-8c4f-00294d1e3b64', function () {
                return view('charity.gifts.view');
            })->name('view');
            // To Add: Add Beneficiary to Gift Giving (via Dropdown)
            // To Add: Add Beneficiary to Gift Giving (via Input Text)
            // To Add: Remove Beneficiary from Gift Giving
            // To Add: Generate tickets for a Gift Giving

            # Charity Admin only
            Route::middleware('charity.admin')->group(function () {
                Route::get('/add', function () { // To add: Middleware must have sufficient star tokens
                    return view('charity.gifts.add');
                })->name('add');
                Route::get('/featured/new/4d4666bb-554d-40b0-9b23-48f653c21e1e', function () { // Add middleware that star tokens must be sufficient
                    return view('charity.main.projects.featured.add');
                })->name('.feature');
            });
        });

        # Audit Logs
        Route::name('audits.')->prefix('/audit-logs')->middleware('charity.admin')->group(function () {
            Route::get('', function () {
                return view('charity.audits.all');
            })->name('all');
            Route::get('/139e93ef-7823-406c-8c4f-00294d1e3b64', function () {
                return view('charity.audits.view');
            })->name('view');
        });

        # Star Tokens
        Route::name('star.tokens.')->prefix('/star-tokens')->middleware('charity.admin')->group(function () {
            Route::get('', function () {
                return view('charity.star-tokens.bal');
            })->name('balance');
            Route::get('/history', function () {
                return view('charity.star-tokens.all');
            })->name('history');
            Route::get('/84d3ad07-fe44-4ba5-9205-e3d68e872fa0', function () {
                return view('charity.star-tokens.view');
            })->name('view');
            Route::get('/order', function () {
                return view('charity.star-tokens.order');
            })->name('order');
        });
    });
});



require __DIR__ . '/auth.php';
