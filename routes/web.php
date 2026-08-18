<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ExpertController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

// หน้าแรก แสดงรายชื่อผู้เชี่ยวชาญที่เผยแพร่
Route::get('/',[ExpertController::class, 'showExperts'])->name('show-expert');

// URL เดิมให้กลับไปหน้าแรก
Route::redirect('/show-expert', '/');

/*
|--------------------------------------------------------------------------
| Authentication routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login',[AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login',[AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::post('/logout',[AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/experts',[ExpertController::class, 'index'])->name('experts.index');
    /*
     * ต้องประกาศ /experts/create
     * ก่อน /experts/{expert}
     */
    Route::get('/experts/create',[ExpertController::class, 'create'])->name('experts.create');
    Route::post('/experts',[ExpertController::class, 'store'])->name('experts.store');
    Route::get('/experts/{expert}/edit',[ExpertController::class, 'edit'])->whereNumber('expert')->name('experts.edit');
    Route::match(['put', 'patch'],'/experts/{expert}',[ExpertController::class, 'update'])->whereNumber('expert')->name('experts.update');
    Route::delete('/experts/{expert}',[ExpertController::class, 'destroy'])->whereNumber('expert')->name('experts.destroy');
     /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    */

    Route::resource('users', UserController::class);
});

/*
|--------------------------------------------------------------------------
| Public expert detail
|--------------------------------------------------------------------------
|
| Route ตัวแปรต้องอยู่ท้ายสุด
|
*/

Route::get('/experts/{expert}',[ExpertController::class, 'show'])->whereNumber('expert')->name('experts.show');