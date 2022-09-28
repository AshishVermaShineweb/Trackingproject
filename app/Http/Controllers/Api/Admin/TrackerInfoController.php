<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrackerInfo;
use Carbon\Carbon;
use Validator;
use App\Models\User;
use App\Models\Company;
use App\Models\Project;

class TrackerInfoController extends Controller
{
    public function list(Request $request){
         $date=date("Y-m-d",$request->trackingDate);
        $data=TrackerInfo::where("trackingDate",$date)->first();

        if($data){
            $data['tracking']=json_decode($data['tracking'],true);
            return response()->json(
                [
                    "message"=>"success",
                    "code"=>200,
                    "data"=>$data,
                ],200
            );
        }
        else{
            return response()->json([
                "message"=>"data not found",
                "code"=>404,

            ],404);
        }





    }
    public function create(Request $request){

       $rule=array(
            "trackingHours"=>"required",
            "trackingDate"=>"required|date_format:Y-m-d",

            "timezone"=>"required",
            "hourLimit"=>"required",
            "userId"=>"exists:users,id",
            "projectId"=>"exists:projects,id",
        );
        $message=array(
            "trackingHours.required"=>"Tracking Hours required",
            "trackingDate.required"=>"Tracking date required",

            "timezone.required"=>"Timezone required",
            "hourLimit.required"=>"Hour Limit required",
            "userId.exists"=>"Select user",
            "projectId.exists"=>"Select project",
            "trackingDate.date_format"=>"Tracking date format is invalid only allow YYYY-m-d",
        );
        try{
            $validate=Validator::make($request->all(),$rule,$message);
        if($validate->fails()){
            return response()->json(
                [
                    'message'=>$validate->errors()->first(),
                    "status"=>"error",
                     "message"=>$validate->errors()->all(),
                ]
            );
        }
        else{



       $trackingDate=$request['trackingDate'];



       $check=TrackerInfo::where(function($query) use($request){
            $query->where("user_id",$request->userId);
            $query->where("project_id",$request->projectId);
            $query->where("trackingDate",$request->trackingDate);
       })->get();


             if(count($check) == 0){

             $info=new TrackerInfo();
             $info->user_id=$request['userId'];
             $info->project_id=$request['projectId'];
             $info->trackingHours=(int)$request->trackingHours;
             $info->trackingDate=$trackingDate;
             $info->tracking=json_encode([$request['tracking']]);
             $info->timezone="ffgvhfvf";
             $info->hourLimit=40;


             if($info->save()){
                return response()->json([
                    "message"=>"success",
                    "code"=>200,
                ],200);
             }
             else{
                return response()->json([
                    "message"=>"something is wrong",
                    "code"=>422,
                ],422);
             }


          }
          else{

            $check=TrackerInfo::where(['user_id'=>$request['userId'],"project_id"=>$request['projectId']])->where('trackingDate',$trackingDate)->first()->toArray();


              $trackingHour=(int)$check['trackingHours']+(int)$request['trackingHours'];

              $new_array = [];


            $tracking_data = json_decode($check['tracking'],true);


            foreach($tracking_data as $key=>$value)
            {
                $new_array[] = $value;

                 array_push($new_array,$request['tracking']);
            }



            $check=TrackerInfo::where(['user_id'=>$request['userId'],"project_id"=>$request['projectId']])->where('trackingDate',$trackingDate)->update(["trackingHours"=>$trackingHour,"tracking"=>json_encode($new_array)]);
              if($check){
                return response()->json(
                    [
                        "message"=>"success",
                        "code"=>200,
                    ],200
                );
              }
              else{
                return response()->json([
                    "message"=>"failed",
                    "code"=>500,
                ],500);
              }

          }




        }
        }
        catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage(),
                "status"=>"error",
            ],400);
        }
    }



    public function getInfo(Request $request){

          try{
            if(isset($request->userId) && isset($request->projectId)){
                $data=Company::join("users",function($join) use($request){
                    $join->on("users.company_id","=","companies.id")
                         ->where("users.id",$request->userId);
                        })
     ->join("projects",function($join) use($request){
          $join->on("projects.company_id","=","companies.id")
              ->where("projects.id",$request->projectId);
     })->select("companies.name as company_name","projects.name as project_name","projects.hourLimit","users.name as username")->get();
         if(!empty($data)){
            return response()->json([
                "message"=>"success",
                "code"=>200,
                "data"=>$data,
            ],200);
         }
         else{
            return response()->json([
                "message"=>"Data not found",
                "code"=>404,

            ],404);

         }
            }
            else{
                return response()->json([
                    "message"=>"User id and project id required",
                    "code"=>404,
                ],404);

            }

          }
          catch(\Exception $e){
            return response()->json([
                "message"=>$e->getMessage(),
                "code"=>500,

            ],500);
          }




    }


    public function getTrackingHour(Request $request){
          try{
            $startDate=Carbon::today()->startOfWeek()->format("Y-m-d");
            $endDate=Carbon::today()->endOfWeek()->format("Y-m-d");
                if(isset($request->projectId) && isset($request->trackingDate) && isset($request->userId)){
                   $checkUserExist=User::where("id",$request->userId)->get()->count();

                   if($checkUserExist>0){
                    $checkUserExist=Project::where("id",$request->projectId)->get()->count();
                    if($checkUserExist>0){
                        $data=TrackerInfo::where("project_id",$request->projectId)->where("user_id",$request->userId)->whereBetween("trackingDate",[$startDate,$endDate])->sum("trackingHours");
                        if(!empty($data)){
                           return response()->json([
                               "message"=>"success",
                               "code"=>200,
                               "totalTrackigHours"=>$data,
                           ],200);
                        }
                        else{
                           return response()->json([
                               "message"=>"Data not found",
                               "code"=>404,

                           ],404);
                        }
                    }
                    else{
                        return response()->json([
                            "message"=>"Project id not exist",
                            "code"=>404,
                        ]);

                    }


                   }
                   else{
                    return response()->json([
                        "message"=>"User id not exist",
                        "code"=>404,
                    ]);
                   }
            }else{
                return response()->json([
                    "message"=>"Project id ,User id and tracking date required",
                    "code"=>404,

                ],404);

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
