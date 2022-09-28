<?php

use App\Http\Controllers\Charity\CharityController;
use App\Http\Controllers\RootAdmin\AdminController;
use App\Http\Controllers\Charity\AuditLogController;
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
        # Donors and Donations Group
        Route::prefix('/donors-and-donations')->group(function () {

            # Leads
            Route::get('/leads', function () {
                return view('charity.donors.leads.all');
            })->name('leads.all');
            Route::get('/leads/9a7445e2-07eb-11ed-861d-0242ac120002', function () {
                return view('charity.donors.leads.view');
            })->name('leads.view');
            // To add - Route::get() for Deleting Leads
            // To add - Route::post() for Storing Leads to Prospects table and deleting the current record in Leads table.

            # Prospects
            Route::get('/prospects', function () {
                return view('charity.donors.prospects.all');
            })->name('prospects.all');
            Route::get('/prospects/93e5c76a-2316-46e4-b24f-b33131100457', function () {
                return view('charity.donors.prospects.view');
            })->name('prospects.view');
            // To add - Route::post() for Moving Prospects back to Leads table and deleting the current record in Prospects table.
            // To add - Route::post() for editing the remarks of Prospects.
        });

        # Our Charitable Organization
        Route::name('charity.')->prefix('/our-charitable-org')->group(function () {

            # Public Profile - Only Charity Admins can access the ff:
            Route::name('profile')->prefix('/profile')->middleware(['charity.admin'])->group(function () {

                # Public Profile
                Route::get('', function () {
                    return view('charity.main.profile.index');
                });
                Route::get('/setup', function () {
                    return view('charity.main.profile.setup');
                })->name('.setup');
                Route::get('/apply-for-verification', function () {
                    return view('charity.main.profile.verify');
                })->name('.verify');


                # Featured Projects
                Route::get('/featured-projects', function () {
                    return view('charity.main.profile.featured-projects.all');
                })->name('.feat-projects');
                Route::get('/featured-projects/6e216252-0443-4326-81a0-3722050bf571', function () {
                    return view('charity.main.profile.featured-projects.view');
                })->name('.feat-projects.view');
                # Add Featured Project (from Existing)
                Route::get('/featured-projects/add', function () { // Add middleware that star tokens must be sufficient
                    return view('charity.main.profile.featured-projects.add');
                })->name('.feat-projects.add');
                # Create New Featured Project
                Route::get('/featured-projects/new', function () { // Add middleware that star tokens must be sufficient
                    return view('charity.main.profile.featured-projects.new');
                })->name('.feat-projects.new');
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
                Route::get('/6a9ae42b-f01e-4b69-a074-7ec7933557fd', function () {
                    return view('charity.main.users.view');
                })->name('.view');
                Route::middleware('charity.admin')->group(function () { // Add middleware: Selected account must be pending (account not yet setup)
                    // To add - Route::get() for deleting pending user accounts permanently (non-refundable).
                });
                // To add - Route::get() for backing up list of Users in their Org via Excel.
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
                Route::post('/save', function () {
                })->name('.update');
                // To add - Route::get() for deleting individual beneficiary records.
                // To add - Route::post() for storing newly created beneficiary records.
                // To add - Route::get() for Backup list of beneficiaries in their Org via Excel.
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
                // To add - Route::get() for Backup list of benefactors in their Org via Excel.
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
                // To add - Route::get() for deleting individual volunteer records.
                // To add - Route::get() for Backup list of volunteers in their Org via Excel.
            });
        });

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
            Route::get('/auditlogs/all', [AuditLogController::class, 'AllAuditLogs'])->name('all');
            // Route::get('/139e93ef-7823-406c-8c4f-00294d1e3b64', function () {
            //     return view('charity.audits.view');
            // })->name('view');
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


# Admin Public Page
Route::controller(AdminController::class)->group(function () {
    # Login
    Route::get('/admin/login', 'adminLogin')->name('admin.login');

    # Logout
    Route::get('/logout', 'destroy')->name('admin.logout');
});


# Root Admin Group Controller
Route::controller(AdminController::class)->prefix('/admin')->name('admin.')->middleware(['auth', 'verified', 'prevent-back-history', 'admin.only'])
    ->group(function () {

        # Admin Panel
        Route::get('/panel', 'showAdminPanel')->name('panel');

        # Admin Profile
        Route::prefix('/profile')->group(function () {
            Route::get('/', 'showProfile')->name('profile');
            Route::get('/edit', 'editProfile')->name('profile.edit');
            Route::post('/store', 'storeProfile')->name('profile.store');
        });

        # Change Password
        Route::prefix('/password')->group(function () {
            Route::get('/change', 'editPassword')->name('password.change');
            Route::post('/store', 'storePassword')->name('password.store');
        });

        # Audit Logs
        Route::name('audit-logs')->prefix('/audit-logs')->group(function () {
            Route::get('/', function () {
                return view('admin.main.audits.all');
            });
        });

        # Notifiers
        Route::name('notifiers')->prefix('/notifiers')->group(function () {
            Route::get('/', function () {
                return view('admin.main.notifiers.all');
            });
            Route::get('/add', function () {
                return view('admin.main.notifiers.add');
            })->name('.add');
            Route::get('/1', function () {
                return view('admin.main.notifiers.view');
            })->name('.view');
            Route::get('/edit/1', function () {
                return view('admin.main.notifiers.edit');
            })->name('.edit');
            // To Add: Store New Notifier
            // To Add: Update Notifier using $id
            // To Add: Delete Notifier using $id
        });
    });


require __DIR__ . '/auth.php';
