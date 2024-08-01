<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\DashboardController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('register', [CustomAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [CustomAuthController::class, 'register']);

Route::get('login', [CustomAuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [CustomAuthController::class, 'login']);

Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');

Route::middleware(['check_auth'])->group(function () {
    Route::get('home', [DashboardController::class, 'index'])->name('home');
    Route::post('addstudent', [DashboardController::class, 'store'])->name('addstudent');
    Route::post('/studentupdate/{id}', [DashboardController::class, 'update'])->name('studentupdate.update');
    Route::delete('/student/{id}', [DashboardController::class, 'destroy'])->name('student.destroy');
});
