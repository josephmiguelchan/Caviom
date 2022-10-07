<?php

use App\Http\Controllers\Charity\CharityController;
use App\Http\Controllers\Charity\BeneficiaryController;
use App\Http\Controllers\Charity\Beneficiary2Controller;
use App\Http\Controllers\Charity\Beneficiary3Controller;
use App\Http\Controllers\Charity\BenefactorController;
use App\Http\Controllers\Charity\VolunteerController;
use App\Http\Controllers\RootAdmin\AdminController;
use App\Http\Controllers\Charity\AuditLogController;
use App\Http\Controllers\Charity\GiftGivingController;
use App\Http\Controllers\Charity\NotificationController;
use App\Http\Controllers\Charity\UserController;
use App\Http\Controllers\RootAdmin\AuditLogController as RootAdminAuditLogController;
use App\Http\Controllers\RootAdmin\CharitableOrganizationController;
use App\Http\Controllers\RootAdmin\FeaturedProjectController;
use App\Http\Controllers\RootAdmin\NotifierController;
use App\Http\Controllers\RootAdmin\UserController as RootAdminUserController;
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

# User Notifications
Route::name('notifications')->middleware(['auth', 'verified', 'prevent-back-history'])->prefix('/notifications')->group(function () {
    # Retrieve All Notifications of User
    Route::get('/', [NotificationController::class, 'AllNotification'])->name('.all');

    # View Notification via $code
    Route::get('/{code}', [NotificationController::class, 'ViewNotification'])->name('.view');

    # Delete Notification
    Route::get('/delete/{code}', [NotificationController::class, 'DeleteNotification'])->name('.delete');

    # Fetch last 3 notifications
    Route::get('/fetchtthreenotification', [NotificationController::class, 'NotificationsData'])->name('.fetch');
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

                # View All user
                Route::get('/', [UserController::class, 'AllUser']);

                # Backup  User
                Route::get('/export', [UserController::class, 'BackupUser'])->name('.export');


                # Charity Admins Only
                Route::middleware(['charity.admin'])->group(function () {

                    # Add User
                    Route::get('/add', [UserController::class, 'UnlockUser'])->name('.add');

                    # Store User
                    Route::post('/store', [UserController::class, 'StoreUser'])->name('.store');

                    # Resend Verification Link
                    Route::post('/{code}/resend-link', [UserController::class, 'resendVerificationLink'])->name('.resend');

                    # Delete (Pending Only) User
                    Route::get('/delete/{code}', [UserController::class, 'DeleteUser'])->name('.delete');
                });


                Route::middleware('charity.admin')->group(function () { // Add middleware: Selected account must be pending (account not yet setup)
                    // To add - Route::get() for deleting pending user accounts permanently (non-refundable).
                });

                # View User Detail
                Route::get('/{code}', [UserController::class, 'ViewUserDetail'])->name('.view');
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

                # Retrieve All Benefactors of Charitable Organization
                Route::get('/', [BenefactorController::class, 'index'])->name('.all');

                # View A Specific Record from Benefactors
                Route::get('/view/{benefactors:code}', [BenefactorController::class, 'show'])->name('.view');

                # Create A Benefactor Record
                Route::get('/create', [BenefactorController::class, 'create'])->name('.create');

                # About to Store the New Benefactor Record
                Route::post('/store', [BenefactorController::class, 'store'])->name('.store');

                # Delete A Benefactor Record
                Route::get('/delete/{benefactors:code}', [BenefactorController::class, 'delete'])->name('.delete');

                # Edit A Benefactor Record
                Route::get('/edit/{benefactors:code}', [BenefactorController::class, 'edit'])->name('.edit');

                # About to Update the Edit Benefactor Record
                Route::post('/update/{benefactors:code}', [BenefactorController::class, 'update'])->name('.update');
            });

            # Volunteers
            Route::name('volunteers')->prefix('/volunteers')->group(function () {

                # Retrieve All Volunteers of Charitable Organization
                Route::get('/', [VolunteerController::class, 'index'])->name('.all');

                # View A Specific Record from Volunteers
                Route::get('/view/{volunteers:code}', [VolunteerController::class, 'show'])->name('.view');

                # Create A Volunteer Record
                Route::get('/create', [VolunteerController::class, 'create'])->name('.create');

                # About to Store the New Volunteer Record
                Route::post('/store', [VolunteerController::class, 'store'])->name('.store');

                # Delete A Volunteer Record
                Route::get('/delete/{volunteers:code}', [VolunteerController::class, 'delete'])->name('.delete');

                # Edit A Volunteer Record
                Route::get('/edit/{volunteers:code}', [VolunteerController::class, 'edit'])->name('.edit');

                # About to Update the Edit Volunteer Record
                Route::post('/update/{volunteers:code}', [VolunteerController::class, 'update'])->name('.update');
            });
        });

        # Gift Givings
        Route::name('gifts.')->prefix('/gift-givings')->group(function () {

            # Retrieve all Gift Givings of Charitable Organization
            Route::get('/all', [GiftGivingController::class, 'AllGiftGiving'])->name('all');

            # View Gift Giving Details
            Route::get('/view/{code}', [GiftGivingController::class, 'ViewGiftGivingProjectDetail'])->name('view');

            # Add Beneficiary to Gift Giving (via Dropdown)
            Route::post('/store/beneficiaries/{code}', [GiftGivingController::class, 'StoreSelectedBeneficiary'])->name('store.selected.beneficiaries');

            # Add Beneficiary to Gift Giving (via Input Text)
            Route::post('/store/custom/beneficiaries/{code}', [GiftGivingController::class, 'StoreCustomBeneficiary'])->name('store.custom.selected.beneficiaries');

            # Remove Beneficiary from Gift Giving
            Route::get('/delete/beneficiaries/{code}', [GiftGivingController::class, 'DeleteGiftGivingBeneficiaries'])->name('delete.selected.beneficiaries');

            # Generate tickets for a Gift Giving
            Route::get('/generate/ticket/{code}', [GiftGivingController::class, 'GenerateTicket'])->name('generate.ticket');

            # Charity Admin only
            Route::middleware('charity.admin')->group(function () {

                # Create Gift Giving (Form)
                Route::get('/add', [GiftGivingController::class, 'AddGiftGiving'])->name('add');

                # Store new Gift Giving Project
                Route::post('/store', [GiftGivingController::class, 'StoreGiftGiving'])->name('store');

                # (TO DO) Feature Gift Giving
                Route::get('/featured/new/4d4666bb-554d-40b0-9b23-48f653c21e1e', function () { // Add middleware that star tokens must be sufficient
                    return view('charity.main.projects.featured.add');
                })->name('.feature');
            });
        });

        # Audit Logs
        Route::name('audits.')->prefix('/audit-logs')->middleware('charity.admin')->group(function () {
            Route::get('/', [AuditLogController::class, 'AllAuditLogs'])->name('all');
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
Route::controller(AdminController::class)->prefix('/admin')->name('admin.')->middleware(['auth', 'verified', 'prevent-back-history', 'admin.only'])->group(function () {

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


    # Charitable Organizations (Verify Profiles)
    Route::name('charities')->prefix('/charitable-organizations')->group(function () {

        # All Charities Organization
        Route::get('/', [CharitableOrganizationController::class, 'AllCharityOrganization'])->name('.all');

        # View Organization Detail
        Route::get('/view/{code}', [CharitableOrganizationController::class, 'ViewCharityOrganization'])->name('.view');

        # Update Profile Settings
        Route::post('/profile/setting/{code}', [CharitableOrganizationController::class, 'CharityProfileSetting'])->name('.profile.update');

        Route::name('.users')->prefix('/users')->group(function () {
            # View Individual Charity User
            Route::get('/{code}', [CharitableOrganizationController::class, 'ViewCharityUserDetail'])->name('.view');

            # Edit Individual Charity User
            Route::get('/edit/{code}', [CharitableOrganizationController::class, 'EditCharityUserDetail'])->name('.edit');

            # To add: (POST) Update User
            Route::post('/edit/{code}', [CharitableOrganizationController::class, 'UpdateCharityUserDetail'])->name('.update');
        });

        // # Send Notification in View Charity

        Route::post('/send/notification/{id}', [CharitableOrganizationController::class, 'SendNotification'])->name('.send.notifcation');

        // To Add: (POST) Edit Profile Settings (Visibility / Verification Status) in View Charity


    });

    # Star Token Orders
    Route::name('orders')->prefix('/orders')->group(function () {
        Route::get('/', function () {
            return view('admin.main.orders.all');
        });
        Route::get('/4de11f39-87b4-433e-a427-b5e214dc42ce', function () {
            return view('admin.main.orders.view');
        })->name('.view');

        // To Add: Delete COMPLETED/REJECTED orders (Optional: Processed Orders that exceeded 15 days)
    });

    # Featured Projects
    Route::name('feat-projects')->prefix('/featured-projects')->group(function () {
     
        Route::get('/', [FeaturedProjectController::class, 'AllFeaturedProject'])->name('.all');

        Route::get('/view/{code}', [FeaturedProjectController::class, 'ViewFeaturedProject'])->name('.view');

        # Approve
        Route::get('/Approved/{code}', [FeaturedProjectController::class, 'ApproveFeaturedProject'])->name('.approve');

        # Reject
        Route::post('/Reject/{code}', [FeaturedProjectController::class, 'RejectFeaturedProject'])->name('.reject');
    });

    # Admin User Accounts
    Route::name('users')->prefix('/users')->controller(RootAdminUserController::class)->group(function () {
        Route::get('/', 'allAdminUsers');
        Route::get('/add', 'addAdminUser')->name('.add');
        Route::post('/store', 'storeAdminUser')->name('.store');
        Route::get('/{code}', 'viewAdminUser')->name('.view');
    });

    # Audit Logs
    Route::name('audit-logs')->prefix('/audit-logs')->group(function () {
        Route::get('/', [RootAdminAuditLogController::class, 'viewAllAudits']);
    });
});

# Notifiers
Route::controller(NotifierController::class)->prefix('/admin/notifiers')->middleware(['auth', 'verified', 'prevent-back-history', 'admin.only'])
    ->group(function () {

        # All notifier
        Route::get('/', 'AllNotifier')->name('admin.notifiers');

        # Add notifier
        Route::get('/add',  'AddNotifier')->name('admin.notifiers.add');

        # Store Notifier
        Route::post('/store',  'StoreNotifier')->name('admin.notifiers.store');

        # View Notifier
        Route::get('/view/{id}',  'ViewNotifier')->name('admin.notifiers.view');

        # Edit Notifier
        Route::get('/edit/{id}',  'EditNotifier')->name('admin.notifiers.edit');

        # Update Notifier
        Route::post('/update/{id}', 'UpdateNotifier')->name('admin.notifiers.update');

        # Delete Notifier
        Route::get('/delete/{id}}', 'DeleteNotifier')->name('admin.notifiers.delete');
    });

Route::name('charities')->prefix('/charitable-organizations')->group(function () {
    Route::get('/', function () {
    })->name('.all');

    Route::get('/5802112d-7751-431d-8caf-5368372f0b1c', function () {
        return view('public.charities.view');
    })->name('.view');
});

require __DIR__ . '/auth.php';
