<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\HousecategoriesController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\TenantsController;
use App\Http\Controllers\UtilitycategoriesController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymenttypesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ReadingController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\RepairworkController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SystemsettingsController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('Home.index');





Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware(['auth','verified'])
            ->name('Dashboard');    

Route::group(['middleware' => ['auth','verified','permission']], function () {

 

Route::get('add-housecategories', [HousecategoriesController::class, 'create'])->name('Housecategories.create');
Route::post('add-housecategories', [HousecategoriesController::class, 'store'])->name('Housecategories.store');
Route::get('housecategories', [HousecategoriesController::class, 'index'])->name('Housecategories.view');
Route::get('edit-housecategories/{id}', [HousecategoriesController::class, 'edit'])->name('Housecategories.edit');
Route::put('update-housecategories/{id}', [HousecategoriesController::class, 'update'])->name('Housecategories.update');

Route::get('delete-housecategories/{id}', [HousecategoriesController::class, 'destroy'])->name('Housecategories.destroy');



/*     House Routes    */
Route::get('add-house', [HouseController::class, 'create'])->name('House.create');
Route::post('add-house', [HouseController::class, 'store'])->name('House.store');
Route::get('house', [HouseController::class, 'index'])->name('House.view');
Route::get('edit-house/{id}', [HouseController::class, 'edit'])->name('House.edit');
Route::put('update-house/{id}', [HouseController::class, 'update'])->name('House.update');

Route::get('delete-house/{id}', [HouseController::class, 'destroy'])->name('House.destroy');

Route::get('view-housemanagers/{id}', [HouseController::class, 'viewManagers'])->name('House.view_managers');
Route::get('edit-housemanagers/{id}', [HouseController::class, 'editManagers'])->name('House.edit_managers');
Route::post('store-housemanagers/{id}', [HouseController::class, 'storeManagers'])->name('House.store_managers');
Route::put('update-housemanagers/{id}', [HouseController::class, 'updateManagers'])->name('House.update_managers');

/*     Tenant Routes    */
Route::get('add-tenants', [TenantsController::class, 'create'])->name('Tenants.create');

Route::post('add-tenants', [TenantsController::class, 'store'])->name('Tenants.store');
Route::get('tenants', [TenantsController::class, 'index'])->name('Tenants.view');
Route::get('edit-tenants/{ID}', [TenantsController::class, 'edit'])->name('Tenants.edit');
Route::put('update-tenants/{ID}', [TenantsController::class, 'update'])->name('Tenants.update');
Route::get('profile-tenants/{ID}', [TenantsController::class, 'profile'])->name('Tenants.profile');
Route::get('attach-tenantmanagers/{ID}', [TenantsController::class, 'attachmanagers'])->name('Tenants.attach_managers');
Route::post('store-tenantmanagers/{ID}', [TenantsController::class, 'storemanagers'])->name('Tenants.store_managers');
Route::put('update-tenantmanagers/{ID}', [TenantsController::class, 'updatemanagers'])->name('Tenants.update_managers');

Route::get('delete-tenants/{ID}', [TenantsController::class, 'destroy'])->name('Tenants.destroy');

/*     Utility Categories Routes    */
Route::get('add-utilitycategories', [UtilitycategoriesController::class, 'create'])->name('Utilitycategories.create');
Route::post('add-utilitycategories', [UtilitycategoriesController::class, 'store'])->name('Utilitycategories.store');
Route::get('utilitycategories', [UtilitycategoriesController::class, 'index'])->name('Utilitycategories.view');
Route::get('edit-utilitycategories/{id}', [UtilitycategoriesController::class, 'edit'])->name('Utilitycategories.edit');
Route::put('update-utilitycategories/{id}', [UtilitycategoriesController::class, 'update'])->name('Utilitycategories.update');

Route::get('delete-utilitycategories/{id}', [UtilitycategoriesController::class, 'destroy'])->name('Utilitycategories.destroy');


/*     Lease Routes    */
Route::get('add-lease', [LeaseController::class, 'create'])->name('Lease.create');
Route::post('add-lease', [LeaseController::class, 'store'])->name('Lease.store');
Route::get('leases', [LeaseController::class, 'index'])->name('Lease.view');
Route::get('edit-lease/{id}', [LeaseController::class, 'edit'])->name('Lease.edit');
Route::put('update-lease/{id}', [LeaseController::class, 'update'])->name('Lease.update');
Route::get('details-lease/{id}', [LeaseController::class, 'details'])->name('Lease.details');
Route::post('api/fetch-leaserent', [LeaseController::class, 'fetchleaserent']);

Route::get('delete-lease/{ID}', [LeaseController::class, 'destroy'])->name('Lease.destroy');

/*     Invoice Routes    */
Route::get('add-invoice', [InvoiceController::class, 'create'])->name('Invoices.create');
Route::get('invoices', [InvoiceController::class, 'index'])->name('Invoices.view');
Route::get('invoice/{year}/{invoicetype}', [InvoiceController::class, 'indexmonth'])->name('Invoices.view_month');
Route::get('invoices/ListInvoices/{year}/{month}/{invoicetype}', [InvoiceController::class, 'ListInvoices'])->name('Invoices.view_list');

Route::post('generateinvoice', [InvoiceController::class, 'GenerateInvoice'])->name('Invoices.generate');

           /* From Lease */
Route::post('Fromlease-invoice', [InvoiceController::class, 'fromleaseInvoice'])->name('Invoices.generaterent');

            /* Permonth */
Route::post('Permonth-invoice', [InvoiceController::class, 'permonthInvoice'])->name('Invoices.generateTrash');


            /* Units */
Route::post('Units-invoice', [InvoiceController::class, 'unitsInvoice'])->name('Invoices.generateWater');

            /* Maintenance */
Route::post('generateMaintenance-invoice', [InvoiceController::class, 'maintenenaceinvoice'])->name('Invoices.generateMaintenance.');

Route::get('edit-invoice/{id}', [InvoiceController::class, 'edit'])->name('Invoices.edit');
Route::put('update-invoice/{id}', [InvoiceController::class, 'update'])->name('Invoices.update');
Route::get('delete-invoice/{id}', [InvoiceController::class, 'destroy'])->name('Invoices.delete');
Route::get('details-invoice/{id}/{lease_id}/{invoicedate}/{invoicetype}', [InvoiceController::class, 'details'])->name('invoices.details_preview');

Route::get('delete-invoices/{ID}', [InvoiceController::class, 'destroy'])->name('Invoices.destroy');
Route::post('api/fetch-rent', [InvoiceController::class, 'fetchRent']);
Route::post('api/fetch-utilities', [InvoiceController::class, 'fetchUtilities']);
Route::post('api/fetch-utilitypayments', [InvoiceController::class, 'fetchUtilityPayments']);



/*     Payment Types Routes    */
Route::get('add-paymenttype', [PaymenttypesController::class, 'create'])->name('Paymenttypes.create');
Route::post('add-paymenttype', [PaymenttypesController::class, 'store'])->name('Paymenttypes.store');
Route::get('paymenttypes', [PaymenttypesController::class, 'index'])->name('Paymenttypes.view');
Route::get('edit-paymenttype/{id}', [PaymenttypesController::class, 'edit'])->name('Paymenttypes.edit');
Route::put('update-paymenttype/{id}', [PaymenttypesController::class, 'update'])->name('Paymenttypes.update');
Route::put('delete-paymenttype/{id}', [PaymenttypesController::class, 'destroy'])->name('Paymenttypes.destroy');

/*     Payments Routes    */
Route::get('add-payment/{id}/{lease_id}/{invoicedate}/{invoicetype}', [PaymentsController::class, 'create'])->name('Payments.create');
Route::post('add-payment', [PaymentsController::class, 'store'])->name('Payments.store');
Route::get('payments', [PaymentsController::class, 'index'])->name('Payments.view');
Route::get('edit-payment/{id}', [PaymentsController::class, 'edit'])->name('Payments.edit');
Route::put('update-payment/{id}', [PaymentsController::class, 'update'])->name('Payments.update');
Route::get('details-receipt/{id}/{lease_id}/{invoicedate}/{invoicetype}', [PaymentsController::class, 'details'])->name('Payments.details');
Route::get('payments/{year}/{paymentitem}', [PaymentsController::class, 'indexmonth'])->name('Payments.view_month');
Route::get('payments/Listpayments/{year}/{month}/{paymentitem}', [PaymentsController::class, 'Listpayments'])->name('Payments.view_list');



Route::get('payments/rentPayments/{year}/{month}', [PaymentsController::class, 'indexrentPayments'])->name('rentPayments');
Route::get('payments/trashPayments/{year}/{month}', [PaymentsController::class, 'indextrashPayments'])->name('waterPayments');
Route::get('payments/waterPayments/{year}/{month}', [PaymentsController::class, 'indexWaterPayments'])->name('waterPayments');

/*     Readings Routes    */
Route::get('add-reading', [ReadingController::class, 'create'])->name('Reading.create');
Route::post('add-reading', [ReadingController::class, 'store'])->name('Reading.store');
Route::get('readings', [ReadingController::class, 'index'])->name('Readings.view');
Route::get('edit-readings/{id}', [ReadingController::class, 'edit'])->name('Reading.edit');
Route::put('update-reading/{id}', [ReadingController::class, 'update'])->name('Reading.edit');
Route::post('api/fetch-id', [ReadingController::class, 'fetchid']);
Route::get('readings/readingsperitem/{year}/{month}', [ReadingController::class, 'indexreadings'])->name('Readings.view_list');


/**
         * User Routes
         */     
Route::get('add-users', [UsersController::class, 'create'])->name('Users.create');
Route::post('add-users', [UsersController::class, 'store'])->name('Users.store');
Route::get('users', [UsersController::class, 'index'])->name('Users.view');
Route::get('/{user}/show', [UsersController::class, 'show'])->name('Users.show');
Route::get('{user}/edit', [UsersController::class, 'edit'])->name('Users.edit');
Route::patch('/{user}/update', [UsersController::class, 'update'])->name('Users.update');
Route::delete('/{user}/delete', [UsersController::class, 'destroy'])->name('Users.destroy');
Route::get('details-users', [UsersController::class, 'details'])->name('Users.details');           
         
        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);

       // * Email Routes
         
Route::get('send-InvoiceEmail/{id}/{lease_id}/{invoicedate}/{invoicetype}', [EmailController::class, 'invoiceEmail'])->name('Email.invoice');
Route::get('previewEmail/{id}/{lease_id}/{invoicedate}/{invoicetype}', [EmailController::class, 'previewEmail'])->name('preview');
Route::get('sent-invoice-emails', [EmailController::class, 'sentInvoiceEmails'])->name('Email.sentinvoice');

Route::get('send-AutomaticInvoiceEmail', [EmailController::class, 'autoinvoiceEmail'])->name('Email.auto_invoice');
Route::get('send-PaymentEmail/{invoice_id}', [EmailController::class, 'receiptMail'])->name('Email.receipt');
Route::get('send-workorderEmail/{maintenance_id}', [EmailController::class, 'workorderMail'])->name('Email.workorder');

/*     Maintenance Routes    */
Route::get('add-maintenance', [MaintenanceController::class, 'create'])->name('Maintenance.create');
Route::post('add-maintenance', [MaintenanceController::class, 'store'])->name('Maintenance.store');
Route::get('YearViewmaintenance', [MaintenanceController::class, 'index'])->name('Maintenance.view_year');
Route::get('MonthViewmaintenance/{year}', [MaintenanceController::class, 'indexmonth'])->name('Maintenance.view_month');
Route::get('Viewmaintenance/{year}/{month}', [MaintenanceController::class, 'viewmaintenance'])->name('Maintenance.view');
Route::get('edit-maintenance/{id}', [MaintenanceController::class, 'edit'])->name('Maintenance.edit');
Route::put('update-maintenance/{id}', [MaintenanceController::class, 'update'])->name('Maintenance.edit');
Route::get('delete-maintenance/{id}', [MaintenanceController::class, 'destroy'])->name('Maintenance.destroy');

/*     Repairwork Routes    */
Route::get('add-repairwork/{id}', [RepairworkController::class, 'create'])->name('Repairwork.create');
Route::post('add-repairwork', [RepairworkController::class, 'store'])->name('Repairwork.store');
Route::get('YearViewrepairwork', [RepairworkController::class, 'index'])->name('Repairwork.view_year');
Route::get('MonthViewrepairwork/{year}', [RepairworkController::class, 'indexmonth'])->name('Repairwork.view_month');
Route::get('Viewrepairwork/{year}/{month}', [RepairworkController::class, 'Viewrepairwork'])->name('Repairwork.view');
Route::get('show-workorder/{id}', [RepairworkController::class, 'show'])->name('Repairwork.workorder_view');
Route::get('edit-workorder/{id}', [RepairworkController::class, 'edit'])->name('Repairwork.edit');
Route::put('update-workorder/{id}', [RepairworkController::class, 'update'])->name('Repairwork.edit');
Route::get('delete-workorder/{id}', [RepairworkController::class, 'destroy'])->name('Repairwork.destroy');

/*     Apartment Routes    */

Route::get('add-apartments', [ApartmentController::class, 'create'])->name('Apartments.create');
Route::post('add-apartments', [ApartmentController::class, 'store'])->name('Apartments.store');
Route::get('apartments', [ApartmentController::class, 'index'])->name('Apartments.view');
Route::get('edit-apartments/{id}', [ApartmentController::class, 'edit'])->name('Apartments.edit');
Route::put('update-apartments/{id}', [ApartmentController::class, 'update'])->name('Apartments.update');

Route::get('delete-apartments/{id}', [ApartmentController::class, 'destroy'])->name('Apartments.destroy');

        
});




/////////////  Error Routes /////////////////
Route::fallback(function(){
    return view('errors.404');
});
/////////////////////////////////////


/*     Tasks Routes    */

Route::get('add-task', [TaskController::class, 'create'])->name('Task.create');
Route::post('add-task', [TaskController::class, 'store'])->name('Task.store');
Route::get('tasks', [TaskController::class, 'index'])->name('Task.view');
Route::get('edit-task/{id}', [TaskController::class, 'edit'])->name('Task.edit');
Route::put('update-task/{id}', [TaskController::class, 'update'])->name('Task.update');

Route::get('delete-task/{id}', [TaskController::class, 'destroy'])->name('Task.destroy');

/*     System Settings Routes    */

Route::get('add-setting', [SystemsettingsController::class, 'create'])->name('Settings.create');
Route::post('add-setting', [SystemsettingsController::class, 'store'])->name('Settings.store');
Route::get('settings', [SystemsettingsController::class, 'index'])->name('Settings.view');
Route::get('edit-setting/{id}', [SystemsettingsController::class, 'edit'])->name('Settings.edit');
Route::put('update-setting/{id}', [SystemsettingsController::class, 'update'])->name('Settings.update');

Route::get('delete-setting/{id}', [SystemsettingsController::class, 'destroy'])->name('Settings.destroy');

Route::get('add-tenantfromuser/{id}', [TenantsController::class, 'createfromuser'])->name('Tenants.create_from_users');



require __DIR__.'/auth.php';







