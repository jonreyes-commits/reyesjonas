
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HealthworkersController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\DoctorController;


Route::get('/', function () {
    return view('landingpage');
});
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get ('/admin', [adminController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get ('/doctor', [DoctorController::class, 'DoctorDashboard'])->name('Doctor.dashboard');
Route::get ('/healthworkers', [HealthworkersController::class, 'HealthworkersDashboard'])->name('Health.workers.dashboard');
