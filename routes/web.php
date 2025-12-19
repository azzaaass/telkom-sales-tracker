
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('user.dashboard');
    // })->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/presence', [PresenceController::class, 'index'])->name('presence');
    Route::post('/presence/clock-in', [PresenceController::class, 'clockIn'])->name('presence.in');
    Route::post('/presence/clock-out', [PresenceController::class, 'clockOut'])->name('presence.out');

    Route::get('/visit', [VisitController::class, 'index'])->name('visit');
    Route::post('/visit', [VisitController::class, 'store'])->name('visit.store');
});
