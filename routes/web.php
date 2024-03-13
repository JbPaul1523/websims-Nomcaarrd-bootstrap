<?php

use App\Http\Controllers\HomeController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/employee', [EmployeeController::class, 'index'])->name('employees');
Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('/employee/{id}/update', [EmployeeController::class, 'update'])->name('employee.update');
// Route::resource('employees', 'EmployeeController');

Route::get('/users',[UserController::class, 'index'])->name('users');
Route::get('/employee/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
