<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseReport;
use App\Http\Controllers\PurchaseReportController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PrCategoryController;
use App\Http\Controllers\PrItemController;
use App\Http\Controllers\PrSignatoryController;

use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// Routes for registered users with admin access
/* Route::middleware(['permission:0', 'auth'])->group(function () {
    /*
        Users or Employee
    Route::middleware(['permission:1'])->group(function () {
        /*
            Admin or superadmin


    });

}); */

// routes/web.php

// routes/web.php

// routes/web.php

use App\Http\Controllers\SupplyReportController;

Route::resource('supply_reports', SupplyReportController::class);
Route::get('supply_reports/{id}/download', [SupplyReportController::class, 'download'])->name('supply_reports.download');





// This ROutes will update in the thoughout the project :)

//route for Employee Admin Only
// Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employees');
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/{id}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/employee/{id}/update', [EmployeeController::class, 'update'])->name('employee.update');
    // Route::resource('employees', 'EmployeeController');

    // Users CRUD route Admin Only
    Route::get('/user', [UserController::class, 'index'])->name('users');
    Route::get('/user/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{id}/deactivate', [UserController::class, 'deactivate'])->name('deactivate.user');
    Route::put('/users/{id}/activate', [UserController::class, 'activate'])->name('activate.user');
// });
// Equipments CRUD Route
// Route::middleware(['auth'])->group(function () {
    Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipments');
    Route::get('/equipment/create', [EquipmentController::class, 'create'])->name('equipment.create');
    Route::get('/equipment/{id}', [EquipmentController::class, 'show'])->name('equipment.show');
    Route::post('/equipment', [EquipmentController::class, 'store'])->name('equipment.store');
    Route::put('/equipment/{id}/update', [EquipmentController::class, 'update'])->name('equipment.update');
    Route::get('/equipment/{id}/update', [EquipmentController::class, 'edit'])->name('equipment.edit');
    Route::delete('/equipment/{id}', [EquipmentController::class, 'destroy'])->name('equipment.destroy');


    // Supplies CRUD Route
    Route::get('/supply', [AssetsController::class, 'index'])->name('supplies');
    Route::get('/supply/create', [AssetsController::class, 'create'])->name('supply.create');
    Route::post('/supply', [AssetsController::class, 'store'])->name('supply.store');
    Route::put('/supply/{id}/update', [AssetsController::class, 'update'])->name('supply.update');
    Route::get('/supply/{id}/update', [AssetsController::class, 'edit'])->name('supply.edit');
    Route::delete('/supply/{id}', [AssetsController::class, 'destroy'])->name('supply.destroy');

    Route::get('/category', [CategoryController::class, 'index'])->name('categories');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/{id}/update', [CategoryController::class, 'edit'])->name('category.edit');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('profile/edit', [UserController::class, 'edit']);

    // Route for Handling the Report
    Route::get('/report', [ReportController::class, 'index'])->name('report');  // show report page
    Route::get('/report/create', [ReportController::class, 'create'])->name('report.create');

Route::get('/purchaseReport',[PurchaseReportController::class,'index'])->name('purchaseReport');
Route::get('/purchaseReport/create', [PurchaseReportController::class, 'create'])->name('purchaseReport.create');
Route::post('/purchaseReport', [PurchaseReportController::class, 'store'])->name('purchaseReport.store');
Route::put('/purchaseReport/{id}/update', [PurchaseReportController::class, 'update'])->name('purchaseReport.update');
Route::get('/purchaseReport/{id}/update', [PurchaseReportController::class, 'edit'])->name('purchaseReport.edit');
Route::delete('/purchaseReport/{id}', [PurchaseReportController::class, 'destroy'])->name('purchaseReport.destroy');


// Route for printing reports
Route::get('employee/equipment/report/{id}', [EmployeeController::class, 'printPDF'])->name('print.employee.equipment');



    //Route for Handling the Supplies Report
    Route::get('/reportsupply', [AssetsController::class, 'suppliesReportIndex'])->name('supplyReport');
    Route::get('/reportequipment', [EquipmentController::class, 'equipmentReportIndex'])->name('equipmentReport');

// });
// Route::get('/PurchaseReport', [PurchaseReportController::class, 'index'])->name('PurchaseReport');


Route::get('/PurchaseReportSignatory', [PrSignatoryController::class, 'index'])->name('PrSignatory');
Route::get('/PurchaseReportSignatory/create', [PrSignatoryController::class, 'create'])->name('PrSignatory.create');
Route::post('/PurchaseReportSignatory', [PrSignatoryController::class, 'store'])->name('PrSignatory.store');
Route::put('/PurchaseReportSignatory/{id}/update', [PrSignatoryController::class, 'update'])->name('PrSignatory.update');
Route::get('/PurchaseReportSignatory/{id}/update', [PrSignatoryController::class, 'edit'])->name('PrSignatory.edit');
Route::delete('/PurchaseReportSignatory/{id}', [PrSignatoryController::class, 'destroy'])->name('PrSignatory.destroy');

// Route::get('/PurchaseReportCategory', [PrCategoryController::class, 'index'])->name('PrCategory');
// Route::get('/PurchaseReportCategory/create',[PrCategoryController::class,'create'])->name('PrCateogry.create');
// Route::post('/PurchaseReportCategory', [PrCategoryController::class, 'store'])->name('PrCategory.store');

Route::get('/PurchaseReportItems', [PrItemController::class, 'index'])->name('PrItem');
Route::get('/PurchaseReportItems/create', [PrItemController::class, 'create'])->name('PrItem.create');
Route::post('/PurchaseReportItems', [PrItemController::class, 'store'])->name('PrItem.store');
Route::put('/PurchaseReportItems/{id}/update', [PrItemController::class, 'update'])->name('PrItem.update');
Route::get('/PurchaseReportItems/{id}/update', [PrItemController::class, 'edit'])->name('PrItem.edit');
Route::delete('/PurchaseReportItems/{id}', [PrItemController::class, 'destroy'])->name('PrItem.destroy');
