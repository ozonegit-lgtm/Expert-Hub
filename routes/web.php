<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ExpertController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('experts.index');
});

Route::middleware('guest')->group(function () {
    Route::get('/login',[AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login',[AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::post('/logout',[AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Expert routes
|--------------------------------------------------------------------------
*/

// หน้ารายการสาธารณะ
Route::get('/experts',[ExpertController::class, 'index'])->name('experts.index');
// ส่วนจัดการสำหรับแอดมิน
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/experts/create',[ExpertController::class, 'create'])->name('experts.create');
    Route::post('/experts',[ExpertController::class, 'store'])->name('experts.store');
    Route::get('/experts/{expert}/edit',[ExpertController::class, 'edit'])->name('experts.edit');
    Route::match(['put', 'patch'],'/experts/{expert}',[ExpertController::class, 'update'])->name('experts.update');
    Route::delete('/experts/{expert}',[ExpertController::class, 'destroy'])->name('experts.destroy');
});

// ต้องวาง route นี้ท้ายสุด เพื่อไม่ให้จับคำว่า create เป็น {expert}
Route::get('/experts/{expert}',[ExpertController::class, 'show'])->name('experts.show');
Route::get('/show-expert', [ExpertController::class, 'showExperts'])->name('show-expert');