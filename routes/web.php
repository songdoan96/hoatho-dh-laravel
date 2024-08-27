<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SimpleController;
use App\Models\Schedule;
use App\Models\Welcome;
use Illuminate\Support\Facades\Route;
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

Route::get('/welcome', function () {
    $images = Welcome::where('active', 1)->get();
    $schedules = Schedule::where('done', 0)->get();
    return view('welcome', compact('images', "schedules"));
});
// Login
Route::get('/dang-nhap', [AuthController::class, 'login'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'store'])->name('login.store');

// Sx
Route::get('/sanxuat', function () {
    return view('produce.dashboard');
})->name('produce.dashboard');

// May mau
Route::prefix("maymau")->name('simple.')->group(function () {
    Route::get('/', [SimpleController::class, 'index'])->name('index');
    Route::get('/baocao', [SimpleController::class, 'dashboard'])->name('dashboard')->middleware('authLogged');

    Route::get('/them', [SimpleController::class, 'add'])->name('add')->middleware('authLogged');
    Route::post('/them', [SimpleController::class, 'store'])->name('store')->middleware('authLogged');

    Route::get('/sua/{simple}', [SimpleController::class, 'edit'])->name('edit')->middleware('authLogged');
    Route::post('/sua/{id}', [SimpleController::class, 'update'])->name('update')->middleware('authLogged');

    Route::delete('/{simple}', [SimpleController::class, 'destroy'])->name('destroy')->middleware('authLogged');
    Route::get('/{tuan}', [SimpleController::class, 'download'])->name('download')->middleware('authLogged');
});

// Ke hoach
Route::prefix('kehoach')->name('plan.')->middleware('authLogged')->group(function () {
    Route::get('/', [PlanController::class, 'dashboard'])->name('dashboard');
    Route::post('/store', [PlanController::class, 'store'])->name('store');
    Route::post('/planUp/{plan}', [PlanController::class, 'planUp'])->name('planUp');
});


Route::prefix("admin")->name('admin.')->middleware('authLogged')->group(function () {
    Route::get('/', [AdminController::class, 'welcome'])->name('welcome');
    Route::post('/uploadStore', [AdminController::class, 'uploadStore'])->name('uploadStore');
    Route::post('/imageChange/{welcome}', [AdminController::class, 'imageChange'])->name('imageChange');
    Route::delete('/imageDelete/{welcome}', [AdminController::class, 'imageDelete'])->name('imageDelete');

    Route::get('/lichlamviec', [AdminController::class, 'schedule'])->name('schedule');
    Route::post('/schedule-store', [AdminController::class, 'scheduleStore'])->name('scheduleStore');
    Route::post('/schedule-done/{schedule}', [AdminController::class, 'scheduleDone'])->name('scheduleDone');
    Route::delete('/schedule-delete/{schedule}', [AdminController::class, 'scheduleDelete'])->name('scheduleDelete');
});
