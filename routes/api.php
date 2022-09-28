<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\CompanyController;
use App\Http\Controllers\Api\Admin\ProjectController;
use App\Http\Controllers\Api\Admin\TrackerInfoController;
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
Route::match(['get','post'],"/tracker-info/create",[TrackerInfoController::class,'create']);
Route::match(['get','post'],"/tracker-info/get-info",[TrackerInfoController::class,'getInfo']);
Route::match(['get','post'],"/tracker-info/list",[TrackerInfoController::class,'list']);
Route::match(['get','post'],"/tracker-info/getTrackingHour",[TrackerInfoController::class,'getTrackingHour']);
// Route::prefix("tracker-info")->group(function(){
//     Route::controller(TrackerInfoController::class)->group(function(){
//     Route::post("/create","create");
//     });
// });
Route::match(['get','post'],"/login",[UserController::class,'login']);
// Route::match(['get','post'],"/tra/create",[UserController::class,'login']);
// Route::group(['middleware'=>"cors"],function(){

// });
Route::get("/project/list",[ProjectController::class,'list']);
Route::post("/project/create",[ProjectController::class,'create']);
Route::post("/forget-password",[UserController::class,'forgetpassword']);
Route::post("/change_password",[UserController::class,'change_password']);
Route::post("/register",[UserController::class,'register']);
Route::post("/company/register",[CompanyController::class,'create']);

Route::middleware('auth:sanctum')->group(function(){
    Route::match(['get','post'],"/tracker-info/getTrackingHour",[TrackerInfoController::class,'getTrackingHour']);
    // Route::get("/user-list",)
    Route::post("/logout-user",[UserController::class,'logout']);
//************************************************************************************************************** */
    //company page routing start
    Route::prefix("company")->group(function(){
    Route::controller(CompanyController::class)->group(function(){
    Route::post("/create",'create');

        });
    });
    //end company page routing start
//*************************************************************************************************************** */




//************************************************************************************************************* */
    //project page routing start
    Route::prefix("project")->group(function(){
        Route::controller(ProjectController::class)->group(function(){
        // Route::post("/create",'create');
        // Route::get("/list","list");

            });
        });
        //end project page routing start
//************************************************************************************************************** */






//****************************************************************************************************************** */
        //tracker info page routing
        // Route::prefix("tracker-info")->group(function(){
        //     Route::controller(TrackerInfoController::class)->group(function(){
        //     Route::post("/create","create");
        //     });
        // });


        //end tracker info page routing
//****************************************************************************************************** */



});


