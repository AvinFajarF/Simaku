<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentsAdminController;
use App\Http\Controllers\SubjectsAdminController;
use App\Http\Controllers\SubjectTeachersAdminController;
use App\Http\Controllers\TeacherAdminController;
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
    Route::post("/admin/siswa", "create")->name("admin.siswa.create");
    Route::post("/admin/siswa/{id}/update", "update")->name("admin.siswa.update");
    Route::delete("/admin/siswa/{id}/delete", "destroy")->name("admin.siswa.delete");

});

Route::controller(TeacherAdminController::class)->group(function() {
    Route::get("/admin/teacher", "index")->name("admin.teacher");
    Route::post("/admin/teacher", "create")->name("admin.teacher.create");
    Route::post("/admin/teacher/{id}/update", "update")->name("admin.teacher.update");
    Route::delete("/admin/teacher/{id}/delete", "destroy")->name("admin.teacher.delete");
});



Route::controller(SubjectsAdminController::class)->group(function() {
    Route::get("/admin/subjects", "index")->name("admin.subjects");
    Route::post("/admin/subjects", "create")->name("admin.subjects.create");
    Route::post("/admin/subjects/{id}/update", "update")->name("admin.subjects.update");
    Route::delete("/admin/subjects/{id}/delete", "destroy")->name("admin.subjects.delete");
});

Route::controller(SubjectTeachersAdminController::class)->group(function() {
    Route::get("/admin/subjects/teacher", "index")->name("admin.subjects.teacher");
    Route::post("/admin/subjects/teacher", "create")->name("admin.subjects.teacher.create");
    Route::post("/admin/subjects/teacher/{id}/update", "update")->name("admin.subjects.teacher.update");
    Route::delete("/admin/subjects/teacher/{id}/delete", "destroy")->name("admin.subjects.teacher.destroy");
});














