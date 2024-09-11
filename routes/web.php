<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\KCSController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProduceController;
use App\Http\Controllers\SimpleController;
use App\Imports\DocumentsImport;
use App\Models\Factory;
use App\Models\KCS;
use App\Models\Plan;
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

// Admin
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


Route::get('/', function () {
    return view('home');
});


Route::get('/test', function () {

    // // Excel::import(new DocumentsImport, 'file.xlsx');

    // dd(1);
    // return;

    $line = "XN1_01";
    $plan = Plan::where('chuyen', $line)
        ->where('daraichuyen', 1)
        ->where('daxong', 0)
        ->orderBy('created_at', 'desc')
        ->first();
    if ($plan) {
        $kcs = KCS::where('plan_id', $plan->id)->where('ngaytao', date("Y-m-d"))->first();
        if (isset($kcs)) {
            $tyledat = ($kcs->sldat / $kcs->chitieungay) * 100;
            $tyleloi = 0;
            if ($kcs->sldat != 0 || $kcs->slloi != 0) {
                $tyleloi = ($kcs->slloi / ($kcs->sldat + $kcs->slloi)) * 100;
            }
            $von = abs(($plan->btpcap - $plan->nhaphoanthanh) / $kcs->chitieungay);
            $errors = explode(",", $kcs->chitietloi);


            $totalHour = 8.5;
            $current_time = strtotime(date("Y-m-d H:i:s"));
            $morning_start = strtotime(date('Y-m-d 07:30:00'));
            $lunch_start = strtotime(date('Y-m-d 11:30:00'));
            $lunch_end = strtotime(date('Y-m-d 12:30:00'));
            $afternoon_start = strtotime(date('Y-m-d 17:00:00'));

            if ($current_time < $morning_start) {
                $totalSecond = 0;
            } elseif ($current_time >= $morning_start && $current_time <= $lunch_start) {
                $totalSecond = $current_time - $morning_start;
            } elseif ($current_time > $lunch_start && $current_time <= $lunch_end) {
                $totalSecond = 4 * 60 * 60;
            } elseif ($current_time > $lunch_end && $current_time <= $afternoon_start) {
                $totalSecond = $current_time - $morning_start - 3600;
            } elseif ($current_time > $afternoon_start) {
                $totalSecond = 8.5 * 60 * 60;
            }
            $ndsx = $totalHour * 3600 / $kcs->chitieungay;
            $dmhientai = ceil($totalSecond / $ndsx);

            return view('test', compact('plan', 'kcs', 'von', 'tyledat', 'tyleloi', 'errors', 'dmhientai'));
        }
    }
    return view('test', compact('plan'));
});

Route::get('/tv', function () {
    $factories = Factory::all();
    return view('tv', compact('factories'));
});


Route::get('/welcome', function () {
    $images = Welcome::where('active', 1)->get();
    $schedules = Schedule::where('done', 0)->get();
    return view('welcome', compact('images', "schedules"));
})->name('welcome');
// Login
Route::get('/dang-nhap', [AuthController::class, 'login'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'store'])->name('login.store');

// Sx
Route::prefix('/sanxuat')->name('produce.')->group(function () {
    Route::get('/', [ProduceController::class, 'dashboard'])->name('dashboard');
    Route::get('/ket-thuc', [ProduceController::class, 'finish'])->name('finish');

    Route::get('/sua-btp/{plan}', [ProduceController::class, 'editBtp'])->name('editBtp');
    Route::post('/sua-btp/{plan}', [ProduceController::class, 'editBtpUpdate'])->name('editBtpUpdate');

    Route::get('/nhap-bo-sung/{plan}', [ProduceController::class, 'supplementWarehouse'])->name('supplementWarehouse');
    Route::post('/nhap-bo-sung/{plan}', [ProduceController::class, 'supplementWarehouseUpdate'])->name('supplementWarehouseUpdate');
});

Route::prefix('kcs')->name('kcs.')->group(function () {
    Route::get('/', [KCSController::class, 'dashboard'])->name('dashboard');
    Route::get('/bao-cao/{kcs}', [KCSController::class, 'edit'])->name('edit');
    Route::get('/them-chi-tieu/{xn}', [KCSController::class, 'add'])->name('add');
    Route::post('/them-chi-tieu', [KCSController::class, 'store'])->name('store');

    Route::post('/passed/{kcs}', [KCSController::class, 'passed'])->name('passed');
    Route::post('/failed/{kcs}', [KCSController::class, 'failed'])->name('failed');
    Route::post('/update-error/{kcs}', [KCSController::class, 'updateErrorInfo'])->name('updateErrorInfo');

    Route::get("/{line}", [KCSController::class, 'line'])->name('line');

    Route::get("/sua-ldong-chitieu/{kcs}", [KCSController::class, 'editWorker'])->name('editWorker');
    Route::post("/sua-ldong-chitieu/{kcs}", [KCSController::class, 'updateWorker'])->name('updateWorker');

    Route::get('/sp-dat-loi/{kcs}', [KCSController::class, 'editPassFail'])->name('editPassFail')->middleware('isAdmin');
    Route::post('/sp-dat-loi/{kcs}', [KCSController::class, 'updatePassFail'])->name('updatePassFail')->middleware('isAdmin');
});

// Ke hoach
Route::prefix('kehoach')->name('plan.')->middleware('authLogged')->group(function () {
    Route::get('/', [PlanController::class, 'dashboard'])->name('dashboard');
    Route::post('/store', [PlanController::class, 'store'])->name('store');

    Route::post('/planUp/{plan}', [PlanController::class, 'planUp'])->name('planUp');
    Route::delete('/planDelete/{plan}', [PlanController::class, 'planDelete'])->name('planDelete');
    Route::post('/planDone/{plan}', [PlanController::class, 'planDone'])->name('planDone');

    Route::get('/sua-logo/{plan}', [PlanController::class, 'editLogo'])->name('editLogo');
    Route::post('/sua-logo/{plan}', [PlanController::class, 'storeLogo'])->name('storeLogo');

    // Route::get('/sua-ke-hoach/{plan}', [PlanController::class, 'editPlan'])->name('editPlan');
    Route::get('/sua-kehoach/{plan}', [PlanController::class, 'editPlan'])->name('editPlan')->middleware('authLogged');
    Route::post('/sua-kehoach/{plan}', [PlanController::class, 'editPlanUpdate'])->name('editPlanUpdate')->middleware('authLogged');


    Route::get('/download/{date}', [PlanController::class, 'download'])->name('download');
});



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


Route::prefix("noibo")->name('internal.')->group(function () {

    Route::get('/tailieu', [DocumentController::class, 'document'])->name('document');

    Route::get('/tailieu/edit/{document}', [DocumentController::class, 'documentEdit'])->name('documentEdit');
    Route::post('/tailieu/edit/{document}', [DocumentController::class, 'documentUpdate'])->name('documentUpdate');

    Route::get("/tailieu/them", [DocumentController::class, 'documentAdd'])->name('documentAdd')->middleware('authLogged');
    Route::post('/tailieu/them', [DocumentController::class, 'documentStore'])->name('documentStore')->middleware('authLogged');

    Route::get('/tailieu/download/{document}', [DocumentController::class, 'documentDownload'])->name('documentDownload');

    Route::delete('/tailieu/{document}', [DocumentController::class, 'documentDelete'])->name('documentDelete');
});
