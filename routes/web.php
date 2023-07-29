<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentsAdminController;
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

Route::controller(DashboardController::class)->group(function() {

    Route::get("/admin", "index")->name("admin");

});

Route::controller(StudentsAdminController::class)->group(function() {

    Route::get("/admin/siswa", "index")->name("admin.siswa");

});
