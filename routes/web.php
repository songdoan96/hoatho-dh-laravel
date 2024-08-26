<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SimpleController;
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

Route::get('/', function () {
    return view('welcome');
});
// Login
Route::get('/dang-nhap', [AuthController::class, 'login'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'store'])->name('login.store');

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
