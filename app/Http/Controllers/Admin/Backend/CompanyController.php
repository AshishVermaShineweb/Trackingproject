<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Auth;
use Validator;
use Hash;

class CompanyController extends Controller
{
    public function login(Request $request){
        $validate=Validator::make($request->all(),

        [
            "email"=>"required|email",
            "password"=>"required",
        ],
        [
            'email.required'=>"Email can`t be empty",
            "password.required"=>"Password can`t be empty",
            "email.email"=>"Email format is invalid",
        ],

    );
    if($validate->fails()){
        return response($validate->getMessage());


    }else{
        $user=Company::where(function($query) use($request){
            $query->where("email","=",$request->email);


        })->first()->toArray();
        if($user){

            if(Hash::check($request->password,$user['password'])){
                session()->put("adminlogin",true);
                return response("success");

            }
            else{
                return response("Password is wrong");
            }

        }
        else{
            return response("Email is wrong");
        }

    }
    }


    public function dashboard(){
        return view("admin.pages.company.index");
    }
}
