<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrackerInfo;
use App\Models\TrackerInfoData;
use App\Models\User;
use App\Models\Project;
use Carbon\Carbon;
use Validator;
use DB;
use Session;


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
        //   echo $check;
        //   die;
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
        ],500);
       }
       else{
        return response()->json([
            "message"=>"not found",
            "code"=>404,

        ],404);
       }

    }




    public function getDataByWeekly(Request $request){
         try{

                   $data=TrackerInfo::where(['user_id'=>$request->userId,'project_id'=>$request->projectId])->get()->groupBy(function($date,$key){
                    return
                        Carbon::parse($date->created_at)->format('W');

                })->toArray();
                if(!empty($data)){
                return response()->json([
                    "message"=>"success",
                    "code"=>200,
                    "data"=>$data,
                ],200);
              }
              else{
                return response()->json([
                    "message"=>"data not found",
                    "code"=>404,

                ],404);

              }

         }
         catch(\Exception $e){
             return response()->json([
                "message"=>$e->getMessage(),
                "code"=>"error",
             ],500);
         }



    }


    public function getUserAssignProjectTrackingData(Request $request){

       if($request->get("user_id")!=null && $request->get("project_id")!=null){
              try{

                $startOfWeek=Carbon::today()->startOfWeek()->format("Y-m-d");
                $endOfWeek=Carbon::today()->endOfWeek()->format("Y-m-d");
                $username=User::where("id",$request->get("user_id"))->select("name","id")->first();
                $projectname=Project::where("id",$request->get("project_id"))->select("name","id")->first();
                //set username and project project name is session so that we can use this at multiple place
                Session::put("username",$username['name']);
                Session::put("projectname",$projectname['name']);
                //end set username and project name in session
                $start_date_array = [];
                $end_date_array = [];
                $data=TrackerInfo::where("user_id",$request->get("user_id"))->where("project_id",$request->get("project_id"))
                  ->select("trackingDate")
                  ->get()->toArray();
                  foreach($data as $list){
                    $start_date = Carbon::parse($list['trackingDate'])->startOfWeek()->format("d/m/Y");
                    $end_date = Carbon::parse($list['trackingDate'])->endOfWeek()->format("d/m/Y");

                    if(!in_array($start_date,$start_date_array))
                    {
                        $start_date_array[] = $start_date;
                        $end_date_array[] = $end_date;
                    }
                  }

                  return view("admin.pages.tracker.trackerInfoList",['start_date'=>$start_date_array,"end_date"=>$end_date_array,"username"=>$username,"projectname"=>$projectname]);

              }
              catch(\Exception $e){
                 return redirect()->back()->with("Something is wrong");
              }

       }
       else{
        return redirect()->back();
       }

    }


    public function getTrackerInfoByDate(Request $request){
        if($request->get("s_d")!=null && $request->get("e_d")!=null && $request->get("p_")!=null && $request->get("u_")){
            $start_date=base64_decode($request->get("s_d"));
            $end_date=base64_decode($request->get("e_d"));
            $start_date=Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
            $end_date=Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');
            $user_id=base64_decode($request->get("u_"));
            $project_id=base64_decode($request->get("p_"));
             try{
                $data=TrackerInfo::join("tracker_info_data",function($join)use($start_date,$end_date){
                    $join->on("tracker_info_data.tracker_id","=","tracker_infos.id");

                  })->where(["user_id"=>$user_id,"project_id"=>$project_id])
                ->whereBetween("trackingDate",[$start_date,$end_date])
                ->groupBy(\DB::raw("date(tracker_infos.trackingDate)"))
                ->select("tracker_infos.trackingDate","tracker_infos.id as tracker_id","tracker_infos.hourLimit")
                ->get()->toArray();
                $totalTrackingHours=TrackerInfo::where(["user_id"=>$user_id,"project_id"=>$project_id])->whereBetween("trackingDate",[$start_date,$end_date])->sum("trackingHours");

                  return view("admin.pages.tracker.tracking_data_list",['data'=>$data,'totalHour'=>$totalTrackingHours]);

            }catch(\Exception $e){

                return redirect()->back()->with(["message"=>$e->getMessage()]);
            }
        }else{
            return redirect()->back()->with(['message'=>"Something is missing try again"]);

        }

    }


    public function getTrackingListById(Request $request){
        $tracker_id=$request->get("tracker_id");
        $data=TrackerInfoData::where("tracker_id",$tracker_id)->get();
        $data=$data->map(function($data){
            return array(
                "tracking_data"=>json_decode(json_decode($data->tracking_data,true),true),
                "tracker_id"=>$data->tracker_id,
                "id"=>$data->id,
                "created_at"=>$data->created_at,
            );
        });
        if(!empty($data)){
            return response()->json([
                "message"=>"success",
                "code"=>200,
                "data"=>$data,
            ],200);
        }else{
            return response()->json([
                "message"=>"data not found",
                "code"=>404,

            ],404);
        }

    }




}
