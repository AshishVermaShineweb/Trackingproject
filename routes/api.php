<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\CompanyController;
use App\Http\Controllers\Api\Admin\ProjectController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/login",[UserController::class,'login']);
Route::post("/forget-password",[UserController::class,'forgetpassword']);
Route::post("/change_password",[UserController::class,'change_password']);

Route::middleware('auth:sanctum')->group(function(){
    // Route::get("/user-list",)
    Route::post("/logout-user",[UserController::class,'logout']);

    //company page routing start
    Route::prefix("company")->group(function(){
    Route::controller(CompanyController::class)->group(function(){
    Route::post("/create",'create');

        });
    });
    //end company page routing start



    //project page routing start
    Route::prefix("project")->group(function(){
        Route::controller(ProjectController::class)->group(function(){
        Route::post("/create",'create');

            });
        });
        //end project page routing start



});


