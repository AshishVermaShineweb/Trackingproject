<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CompanyController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


//admin routing start
Route::get("/admin/dashboard",[AdminController::class,'index']);
Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin']],function(){

    //company page routing start //
    Route::get("/company",[CompanyController::class,'index'])->name("admin.company");

    //end company page routing end //

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get("/pass",function(){
//     echo Hash::make("admin@123");

// });
