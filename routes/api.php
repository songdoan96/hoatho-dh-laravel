<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix("v1")->group(function () {
    Route::get("/", function () {
        return response()->json(
            [
                "message" => "success",
                "data" => [
                    "XN1" => [
                        "chuyen" => "01",
                        "tacnghiep" => 2000
                    ],
                    "XN2" => [
                        "chuyen" => "02",
                        "tacnghiep" => 3000
                    ]
                ],
            ],
            200
        );
    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
