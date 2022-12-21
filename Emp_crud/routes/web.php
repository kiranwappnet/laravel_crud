<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UploadImageController;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DropdownController;


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

Route::get('/sendm', function(){
    Mail::to("smit.wappnet@gmail.com")->send(new MyMail());
});

// Guest User
Route::get('/', [GuestController::class, 'index'])->middleware('guest')->name("welcome");


Route::get('/signin', [AuthController::class, 'signin_view'])->middleware('guest')->name("auth.signin");
Route::post('/signin', [AuthController::class, 'signin'])->middleware('guest');

Route::get('/employees', [AuthController::class, 'employees_view'])->middleware('auth')->name('employees');

Route::get('/signup', [AuthController::class, 'signup_view'])->middleware('guest')->name("auth.signup");
Route::post('/signup', [AuthController::class, 'signup'])->middleware('guest');

Route::get('/forgot-password', [AuthController::class, 'forgot_password_view'])->middleware('guest')->name('auth.forgot-password');
Route::post('/forgot-password', [AuthController::class, 'forgot_password'])->middleware('guest');

Route::get('/profilechanged', [AuthController::class, 'profilechanged_view'])->middleware('guest')->name('auth.profilechanged');

Route::get('/reset-password/{token}', [AuthController::class,'reset_password_view'])->middleware('guest')->name('password.reset');
Route::post('/reset-password/{token}', [AuthController::class,'reset_password'])->middleware('guest')->name("auth.reset-password");

// After Login
Route::get('/', [AuthController::class, 'dashboard'])->middleware("auth");

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware("auth")->name('dashboard');
Route::get('/employees', [EmployeeController::class, 'index'])->middleware('auth')->name('employees');
Route::get('/documents', [AuthController::class, 'documents_view'])->middleware('auth')->name('documents');
Route::post('/employees', [EmployeeController::class, 'create'])->middleware('auth');
Route::get('/employees/delete/{employee}', [EmployeeController::class, 'delete'])->middleware('auth')->name('employees.delete');
Route::get('/employees/edit/{employee}', [EmployeeController::class, 'edit'])->middleware('auth')->name('employees.edit');
Route::post('/employees/edit/{employee}', [EmployeeController::class, 'update'])->middleware('auth')->name('employees.edit');


Route::get('/signout', [AuthController::class, 'signout'])->middleware('auth')->name('signout');

Route::get('/employees', [DropdownController::class, 'state'])->middleware('auth')->name('employees');
Route::post('/fetch-cities', [DropdownController::class, 'fetchCity']);


