<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SimpleRegisterController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\UserController;


use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});





 Route::middleware('guest')->group(function () {
        // Login
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

        // Register
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
        
        // Forgot Password
        Route::get('/forgot-password', [ResetPasswordController::class, 'showForgotForm'])->name('password.request');
        Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->name('password.email');

        // Reset Password
        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
    });



// Admin Guest Routes (not logged in)
Route::prefix('admin')->name('admin.')->group(function () {

   
 


Route::post('/register-test', function() {
    return 'Test route is working!';
});




    

    // Admin Authenticated Routes (logged in)
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


        // Property Management
        Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
        Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
        Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
        Route::get('/properties/show/{id}', [PropertyController::class, 'showPropertyById'])->name('show.property');
        Route::get('property/edit/{id}', [PropertyController::class, 'edit'])->name('edit.property');
        Route::post('property/edit/{id}',[PropertyController::class,'updateProperty'])->name('update.property');
        Route::get('property/delete/{id}', [PropertyController::class, 'deleteProperty'])->name('delete.property');


        //User Management
        Route::get('/users',[UserController::class, 'index'])->name('users.index');
        Route::get('/users/show/{id}',[UserController::class, 'show'])->name('users.show');
        Route::get('/users/edit/{id}',[UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/edit/{id}',[UserController::class, 'edit'])->name('users.update');
        Route::patch('/users/toggle-status/{id}/toggle-status',[UserController::class, 'toggleStatus'])->name('users.toggle-status');
        Route::get('/users/delete-user/{id}',[UserController::class, 'delete'])->name('delete.user');
        
    });

});

Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');


Route::get('/admin/register-simple', [SimpleRegisterController::class, 'showForm']);
Route::post('/admin/register-simples', [SimpleRegisterController::class, 'register']);