<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\FrontUserController;

Route::prefix("users")->group(function(){
    Route::controller(FrontUserController::class)->group(function(){
    Route::get("",'list');
    Route::get("/add",'add');
    Route::match(['get','post'],"/create",'store');
    Route::get("delete/{id}","delete");
    Route::get("edit/{id}","edit");
    Route::match(['get','post'],"update","update");
    });
    });



?>
