<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Hash;
use App\Models\FrontUser;
use Carbon\Carbon;
use Auth;



class FrontUserController extends Controller
{

    function __construct(){
        $this->middleware("guest:front");
    }

    public function list(){
        return view("admin.pages.user.list");
    }


    public function store(Request $request){
            if(AUth::guard("company")->check()){
                echo "login";

            }else{
                echo "not login";
            }
            die;
        $rule=array(
            "firstname"=>"required",
            "lastname"=>"required",
            "email"=>"required|unique:frontusers",
            "phone"=>"required|integer",
            "dob"=>"required",
            "department"=>"required",
            "username"=>"required|unique:frontusers",
            "password"=>"required|min:8",
            "role"=>"required",
            "confirm-password"=>"required|same:password"
        );
        $message=array(
            "firstname.required"=>"First name can`t be empty",
            "lastname.required"=>"Last name can`t be empty",
            "email.required"=>"Email can`t be empty",
            "phone.required"=>"Phone no can`t be empty",
            "dob.required"=>"Date of Birth can`t be empty",
            "department.required"=>"Select Department",
            "username.required"=>"Username can`t be empty",
            "password.required"=>"Password can`t be empty",
            "role.required"=>"Select Role",
            "confirm-password.required"=>"Confirm password can`t be empty",
            "confirm-password.same"=>"Confirm password not same",
        );

            $validate=Validator($request->all(),$rule,$message);

          if($validate->fails()){

            return response()->json([
                "message"=>$validate->errors()->first(),
                "error"=>$validate->errors(),

                "status"=>"error",

            ],422);
          }
          else{

            try{
                if($request->notify=="on"){

                }

                $check=FrontUser::where("email",$request->email)->exists();
                if($check){
                    return response()->json([
                        "message"=>"Email already exist",
                        "status"=>"error",
                    ]);
                }
                else{
                    $check=FrontUser::where("username",$request->username)->exists();
                    if($check){
                        return response()->json([
                            "message"=>"Username is alredy exist",
                            "status"=>"error",
                        ]);
                    }
                    else{

                        $request->request->add(['token'=>\Str::random(30),"loginip"=>$request->ip(),"last_logindate"=>Carbon::now()->format('Y-m-d'),"timezone"=>"Asia\Culcata","company_id"=>47664]);
                          try{
                            if(FrontUser::create($request->all())){
                                return response()->json([
                                    "message"=>"success",
                                    "status"=>200,
                                ]);
                            }else{
                                return response()->json([
                                    "message"=>"something is wrong",
                                    "status"=>500,
                                ]);
                            }
                          }
                          catch(\Illuminate\Database\QueryException $e){
                            return response()->json([
                                "message"=>$e->getMessage(),
                                "status"=>500,
                            ],500);

                          }



                    }

                }

            }
            catch(\Exception $e){
                return response()->json([
                    "message"=>$e->getMessage(),
                    "status"=>"error",
                ],500);

            }



          }
    }

}
