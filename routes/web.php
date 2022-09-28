<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\CompanyController;
use App\Http\Controllers\Backend\Admin\UserController;
use App\Http\Controllers\Backend\Admin\ProjectController;
use App\Http\Controllers\Backend\Admin\TrackerInfoController;
use App\Http\Controllers\Backend\Admin\RoleController;
use App\Http\Controllers\Backend\Admin\FrontUserController;
use Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get("/demo",function(){
// return view("demo");
// });

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


//admin routing start
Route::get("/login",function(){
    return view("login");
});
Route::match(['get','post'],"/login-data",[CompanyController::class,"login"]);

Route::group(['prefix' => 'company', 'middleware' => ['checkadmin']],function(){
    Route::get("/dashboard",[AdminController::class,'index']);

    Route::get("/company",[CompanyController::class,'index'])->name("admin.company");

    //user routing start
     Route::get("/users",[UserController::class,"list"]);
    //end user routing end
//************************************************************************************************************************ */
    //project routing list
    Route::prefix("project")->group(function(){
    Route::controller(ProjectController::class)->group(function(){
    Route::get("",'list');
    Route::get("/add",'add');
    Route::post("/create",'store');
    Route::get("delete/{id}","delete");
    Route::get("edit/{id}","edit");
    Route::match(['get','post'],"update","update");
    });
    });
    //end project routing
//*************************************************************************************************************** */

//************************************************************************************************************************ */



    //*************************************************************************************************************** */



    //************************************************************************************************************************ */
    //tracker info routing list
    Route::prefix("tracker-info")->group(function(){
        Route::controller(TrackerInfoController::class)->group(function(){
        Route::get("",'list');
        Route::get("/add",'add');
        Route::match(['get','post'],"/create",'store');
        Route::get("delete/{id}","delete");
        Route::get("edit/{id}","edit");
        Route::match(['get','post'],"update","update");
        });
        });
        //end tracker info routing
    //*************************************************************************************************************** */

   //setting page routing start
    /*************************************************************************************************/
      Route::get("/setting",function(){
        return view("admin.pages.setting.index");
      });

   /**************************************************************************************************/
   //end setting page routing

     //roles page routing
   //********************************************************************************************/
   Route::prefix("roles")->group(function(){
    Route::controller(RoleController::class)->group(function(){
    Route::get("",'list');
    Route::get("/add",'add');
    Route::post("/create",'store');
    Route::get("delete/{id}","delete");
    Route::get("edit/{id}","edit");
    Route::match(['get','post'],"update","update");
    Route::match(['get','post'],"/list-data","get_list");
    });
    });
   //**********************************************************************************************/
   //end roles page routing


   //----------------- front users routing start ---------------------------------------------------//
                  require __DIR__.'/usermanagement/index.php';
   //----------------- end front user routing end --------------------------------------------------//
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("/pass",function(){
    echo Hash::make("12345678");

});

Route::match(['get','post'],"/tracker-info/create",[TrackerInfoController::class,'create']);
Route::match(['get','post'],"/tracker-info/get-info",[TrackerInfoController::class,'getInfo']);
Route::match(['get','post'],"/tracker-info/list",[TrackerInfoController::class,'list']);

Route::match(['get','post'],"/tracker-info/getDataByWeekly",[TrackerInfoController::class,'getDataByWeekly']);


//create migra
Route::get("/migrate",function(){
    Artisan::call('migrate');
    return "Data Migrated";
});
