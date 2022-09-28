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
use App\Models\User;

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

                $request->request->add(['company_id'=>Auth::user()->id]);



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

            //start check
$allData=array();
$startDate=Carbon::today()->startOfWeek()->format("Y-m-d");
$endDate=Carbon::today()->endOfWeek()->format("Y-m-d");
$allProject=Project::where("user_id",$request->userId)->get()->toArray();
  foreach($allProject as $project){
    $trackingData=TrackerInfo::where("user_id",$request->userId)->where("project_id",$project['id'])->whereBetween("trackingDate",[$startDate,$endDate])->sum("trackingHours");
    if(($trackingData)>0){
        $data=[
            "name"=>$project['name'],
            "description"=>$project['description'],
            "hourLimit"=>$project['hourLimit'],
            "trackingHours"=>$trackingData,
            "project_id"=>$project['id'],


        ];
        array_push($allData,$data);
    }
    else{
        $data=[
            "name"=>$project['name'],
            "description"=>$project['description'],
            "hourLimit"=>$project['hourLimit'],
            "trackingHours"=>0,
            "project_id"=>$project['id'],


        ];
        array_push($allData,$data);

    }


  }
  return response()->json([
    "message"=>"success",
    "data"=>$allData,
    "code"=>200,
  ],200);

  }
  catch(\Exception $e){
    return response()->json([
        "message"=>$e->getMessage(),
        "code"=>500,
    ],500);

  }
    //     try{
    //         if(isset($request->userId)){
    //             $check=Project::where("user_id",$request->userId)->select(['name',"hourLimit","description","id as project_id"])->get();
    //             if(count($check)>0){
    //                 $startDate=Carbon::today()->startOfWeek()->format("Y-m-d");
    //                 $endDate=Carbon::today()->endOfWeek()->format("Y-m-d");
    //                $data=Project::join("tracker_infos","tracker_infos.project_id","=","projects.id");
    //                $data=$data->select("projects.name","projects.description","projects.hourLimit","tracker_infos.trackingHours","tracker_infos.project_id");
    //                $data=$data->where("projects.user_id",$request->userId);
    //                $data=$data->whereBetween("tracker_infos.trackingDate",[$startDate,$endDate]);
    //                $data=$data->groupBy("project_id");

    //                $data=$data->get()->toArray();
    //             //    print_r($data);
    //             //    die;
    //                $alldata=array();
    //                foreach($data as $key=>$list){
    //                    $project_id=$list['project_id'];
    //                    $data[$key]['trackingHours']=TrackerInfo::where("project_id",$list['project_id'])->whereBetween("trackingDate",[$startDate,$endDate])->groupBy("project_id")->sum("trackingHours");
    //                }

    //                       if($data){
    //                        //getting total hour tracking
    //                      return response()->json(
    //                        [
    //                            'message'=>"success",
    //                            "data"=>$data,
    //                            "code"=>200,
    //                        ],200
    //                    );
    //                }
    //                else{
    //                    return response()->json(
    //                        [
    //                            'totalTrackingHours'=>0,
    //                            "data"=>$check,

    //                            "code"=>200,
    //                        ],200
    //                    );

    //                }

    //             }else{
    //                 return response()->json([
    //                     "message"=>"No Any Project Assigned "
    //                 ]);
    //             }
    //         }
    //         else{
    //             return response()->json([
    //                 "message"=>"user id can`t be empty",
    //                 "code"=>422,
    //             ],422);
    //         }
    //    }
    //    catch(\Exception $e){
    //     return response()->json([
    //         "message"=>$e->getMessage(),
    //         "code"=>500,
    //     ],500);
    //    }
         }

}
