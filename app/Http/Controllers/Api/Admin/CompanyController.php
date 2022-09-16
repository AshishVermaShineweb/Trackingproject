<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Validator;
use Auth;
use App\Models\Company;


class CompanyController extends Controller
{
    public function create(Request $request){

      try{
        $rule=array(
            "name"=>"required",
            "email"=>"required|email",
            "password"=>['required','min:8',"string",'regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'],
            "timezone"=>"required",


         );
         $message=array(
            "name.required"=>"Company name can`t be empty",
            "email.required"=>"Email can`t empty",
            "email.email"=>"Email format is invalid",
            "password.required"=>"Password can`t be empty",
            "timezone.required"=>"Timezone can`t be empty",
         );

         $validate=Validator::make($request->all(),$rule,$message);
         if($validate->fails()){
            return response()->json(
                [
                    "message"=>$validate->errors()->first(),
                    "status"=>"error",
                    "error"=>$validate->errors()->all(),
                ]
            );
         }
         else{
            $token=Hash::make(\Str::random(20));
            $request->request->add(['token'=>$token]);
              $request->request->add(['loginip'=>$request->ip()]);
            //   print_r(json_encode($request->all()));
            //   die;

            //   $request->request->add(['token'=>]);
              //check company exist or not
              $existOrNot=Company::where("name","=",$request->name)->exists();
              if(!$existOrNot){
                $existOrNot=Company::where("email","=",$request->email)->exists();
                if(!$existOrNot){

                    $create=Company::create($request->all());
                    if($create){
                        return response()->json(

                            [
                                'message'=>"Company Created Successfully",
                                "status"=>200,
                            ]
                        );
                    }

                }
                else{
                    return response()->json(
                        [
                            "message"=>"Company email is already exist",
                            "status"=>"error",
                        ],409
                    );

                }
              }else{
                return response()->json(
                    [
                        "message"=>"Company name is already exist",
                        "status"=>"error",
                    ],409
                );
              }


         }

      }
      catch(\Throwable $e){
        return response()->json(

            [
                'message'=>$e,
                "status"=>"error",
            ]
        );

      }

    }


    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
}
