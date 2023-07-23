<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherJournalsController;
use App\Http\Controllers\TeacherPermissionsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("/v1")->group(function() {


    // router untuk authenticated
    Route::controller(AuthController::class)->group(function() {
        // router untuk login
        Route::post("/login", "login");
    });

    Route::middleware('auth:sanctum')->group(function() {


        Route::controller(TeacherPermissionsController::class)->group(function() {

            // create permission for teacher
            Route::post("/teacher/permission", "CreateTeacherPermissions")->middleware("teacher.auth");
            // create setting for teacher permission
            Route::post("/admin/permission/settings", "TeacherPermissionSettings")->middleware("admin.check");
        });


        Route::controller(TeacherJournalsController::class)->middleware("teacher.auth")->group(function() {
            // create journals
            Route::post("/teacher/journals", "CreateJournals");
            // get all students by class
            Route::get("/teacher/students", "GetStudentData");
        });




    });
});
