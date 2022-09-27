<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrackerInfo;
use Validator;
use Carbon\Carbon;
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
             "trackingDate"=>"required",

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



        $date=date("Y-m-d",($request['trackingDate']));

        $trackingDate=$date;

        $check=TrackerInfo::where(['user_id'=>$request['userId'],"project_id"=>$request['projectId']])->where('trackingDate',$date)->get();
        //    echo $check;
        //    die;
              if(count($check) == 0){

              $info=new TrackerInfo();
              $info->user_id=1;
              $info->project_id=1;
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

             $check=TrackerInfo::where(['user_id'=>$request['userId'],"project_id"=>$request['projectId']])->where('trackingDate',$date)->first()->toArray();


               $trackingHour=(int)$check['trackingHours']+(int)$request['trackingHours'];

             $new_array = [];


             $tracking_data = json_decode($check['tracking'],true);


             foreach($tracking_data as $key=>$value)
             {
                 $new_array[] = $value;

                  array_push($new_array,$request['tracking']);
             }



             $check=TrackerInfo::where(['user_id'=>$request['userId'],"project_id"=>$request['projectId']])->where('trackingDate',$date)->update(["trackingHours"=>$trackingHour,"tracking"=>json_encode($new_array)]);
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
        $date=date("Y-m-d",$request->date);
        $query=TrackerInfo::query();
        $query->join("users as u",function($join) use($request){
         $join->on("u.id","=","tracker_infos.user_id");
         });
       $query->join("projects as p","p.id","=","tracker_infos.project_id");
       $query->select("u.name as username,","tracker_infos.*","u.email as user_email","p.name as project_name");
       $query->where(function($query) use($request,$date){
       $query->where("tracker_infos.user_id","=",$request->userId);
       $query->where("tracker_infos.project_id","=",$request->projectId);
       $query->where("tracker_infos.trackingDate","=",$date);
       });
       $query=$query->get();
        $query->map(function($query){
         return array(
             $query['tracking']=json_decode($query['tracking'],true),
             $query['project_name']=ucfirst($query['project_name']),
         );
         });

    if(isset($query) && count($query)>0){
     return response()->json([
         "message"=>"success",
         "code"=>200,
         "data"=>$query->toArray(),
     ],200);
    }
    else{
     return response()->json([
         "message"=>"not found",
         "code"=>404,

     ],404);
    }

 }



}
