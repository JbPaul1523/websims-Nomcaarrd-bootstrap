<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\CategoryController;
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
    return view('home');
});

//Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// This ROutes will update in the thoughout the project :)

//route for Employee
Route::get('/employee', [EmployeeController::class, 'index'])->name('employees');
Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('/employee/{id}/update', [EmployeeController::class, 'update'])->name('employee.update');
// Route::resource('employees', 'EmployeeController');

// Users CRUD route
Route::get('/user', [UserController::class, 'index'])->name('users');
Route::get('/user/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Equipments CRUD Route
Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipments');
Route::get('/equipment/create', [EquipmentController::class, 'create'])->name('equipment.create');
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
