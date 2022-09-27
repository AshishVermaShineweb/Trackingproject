<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Hash;
use App\Models\Project;
use Carbon\Carbon;
use App\Models\TrackerInfo;

class ProjectController extends Controller
{
    public function create(Request $request){

        try{

            $rule=array(
                "name"=>"required",
                "hourLimit"=>"required|integer",
                "user_id"=>"required|exists:users,id",



             );
             $message=array(
                "name.required"=>"Company name can`t be empty",
                "hourLimit.required"=>"Hour limit can`t empty",
                "hourLimit.integer"=>"Hour limit should be number",
                "user_id.exists"=>"Select users",


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

                $request->request->add(['company_id'=>1]);



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


    public function list(Request $request){
         try{
            if(isset($request->userId)){
                $startDate=Carbon::today()->startOfWeek()->format("Y-m-d");
            $endDate=Carbon::today()->endOfWeek()->format("Y-m-d");
           $data=Project::join("tracker_infos","tracker_infos.project_id","=","projects.id");
           $data=$data->select("projects.name","projects.description","projects.hourLimit","tracker_infos.trackingHours","tracker_infos.project_id");
           $data=$data->where("projects.user_id",$request->userId);
           $data=$data->whereBetween("tracker_infos.trackingDate",[$startDate,$endDate]);
           $data=$data->groupBy("project_id");

           $data=$data->get()->toArray();
        //    print_r($data);
        //    die;
           $alldata=array();
           foreach($data as $key=>$list){
               $project_id=$list['project_id'];
               $data[$key]['trackingHours']=TrackerInfo::where("project_id",$list['project_id'])->whereBetween("trackingDate",[$startDate,$endDate])->groupBy("project_id")->sum("trackingHours");
           }

                  if($data){
                   //getting total hour tracking
                 return response()->json(
                   [
                       'message'=>"success",
                       "data"=>$data,
                       "code"=>200,
                   ],200
               );
           }
           else{
               return response()->json(
                   [
                       'message'=>"No any project assign",

                       "code"=>200,
                   ],200
               );

           }
            }
            else{
                return response()->json([
                    "message"=>"user id can`t be empty",
                    "code"=>422,
                ],422);
            }
       }
       catch(\Exception $e){
        return response()->json([
            "message"=>$e->getMessage(),
            "code"=>500,
        ],500);
       }
         }

}
