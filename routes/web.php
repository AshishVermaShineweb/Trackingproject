<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\CompanyController;
use App\Http\Controllers\Backend\Admin\UserController;
use App\Http\Controllers\Backend\Admin\ProjectController;
use App\Http\Controllers\Backend\Admin\TrackerInfoController;
use App\Http\Controllers\Backend\Admin\RoleController;
use App\Http\Controllers\Backend\Admin\FrontUserController;
use App\Http\Controllers\Backend\Admin\PermissionController;
use App\Models\TrackerInfoData;

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


Route::get("/company/tracker/user",[TrackerInfoController::class,'userList']);
Route::get("/company/tracker/user/project/{id}",[ProjectController::class,'getProjectListAssignedUser']);
Route::get("/company/tracker/user/trackerInfo",[TrackerInfoController::class,'getUserAssignProjectTrackingData']);
Route::get("/company/tracker/user/trackerInfoByDate",[TrackerInfoController::class,"getTrackerInfoByDate"]);
Route::get("/company/tracker/user/getTrackingListById",[TrackerInfoController::class,"getTrackingListById"]);
Route::get("/company/tracker/user/getTrackerInfoBySpecificDate",[TrackerInfoController::class,'getTrackerInfoBySepcificDate']);
//create migrate
// Route::get("/migrate",function(){
//     Artisan::call('migrate');

// });



Route::get("/demo",[TrackerInfoController::class,'create']);
Route::get("/check",function(){
    echo "<pre>";
         $data=TrackerInfoData::cursor()->remember();
         $data=$data->toArray();

         dd($data);
    echo "</pre>";

});


Route::get("/permission",[PermissionController::class,'create']);
//-------------------- ROLE ROUTINGS STARTS ----------------------------------------------------//
Route::post("/company/roles/add",[RoleController::class,"add"]);
Route::get("/company/roles/list",[RoleController::class,"listdata"]);
Route::get("/company/roles/delete",[RoleController::class,"delete"]);
Route::post("/company/roles/update",[RoleController::class,"update"]);
//--------------------END ROLE ROUTING ----------------------------------------------------------//

//------------------------------ PERMISSION ROUTING START ---------------------------------------//
Route::get("/company/permission",[PermissionController::class,"list"]);
Route::post("/company/permission/add",[PermissionController::class,"add"]);
Route::get("/company/permission/list",[PermissionController::class,"listdata"]);
Route::get("/company/permission/delete",[PermissionController::class,"delete"]);
Route::post("/company/permission/update",[PermissionController::class,"update"]);
//------------------------------ PERMISSION ROTUNG END -----------------------------------------//

