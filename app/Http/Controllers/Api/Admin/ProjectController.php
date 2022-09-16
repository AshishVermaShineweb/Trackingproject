<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Hash;
use App\Models\Project;

class ProjectController extends Controller
{
    public function create(Request $request){
        try{

            $rule=array(
                "name"=>"required",
                "hourLimit"=>"required|integer",



             );
             $message=array(
                "name.required"=>"Company name can`t be empty",
                "hourLimit.required"=>"Hour limit can`t empty",
                "hourLimit.integer"=>"Hour limit should be number",

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

                $request->request->add(['company_id'=>Auth::user()->company_id]);
                  $request->request->add(['user_id'=>Auth::user()->id]);


                  //check project exist or not
                  $existOrNot=Project::where("name","=",$request->name)->exists();
                  if(!$existOrNot){
                    $create=Project::create($request->all());
                    if($create){
                        return response()->json(
                            [
                                'message'=>"Project created successfully",
                                "status"=>200,
                            ]
                        );
                    }
                    else{
                        return response()->json([
                            'message'=>"Something is wrong try again",
                            "status"=>"error",

                        ],503);
                    }

                  }
                  else{
                    return response()->json(
                        [
                            "message"=>"Project name is already exist",
                            "status"=>"error",
                        ],409
                    );
                  }


             }
        }
        catch(\Exception $e){
            return response()->json(
                [
                    'message'=>$e->getMessage(),
                    "status"=>"error",
                ]
            );
        }
    }
}
