<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
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

Route::middleware('auth')->group(function () {
    // Home
    Route::get('/', [RestaurantController::class, 'index'])->name('home');

    // Restaurant
    Route::resource('restaurant', RestaurantController::class)->except(['show']);

    // Profile
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Password
    Route::patch('password', [PasswordController::class, 'update'])->name('password.update');

    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware('guest')->group(function () {
    // New user's registration
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    // Login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});
