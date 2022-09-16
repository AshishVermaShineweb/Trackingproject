<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrackerInfo;
use Validator;
class TrackerInfoController extends Controller
{
    public function create(Request $request){
        $rule=array(
            "trackingHours"=>"required",
            "trackingDate"=>"required",
            "tracking"=>"required",
            "timezone"=>"required",
            "hourLimit"=>"required",
        );
        $message=array(
            "trackingHours.required"=>"Tracking Hosurs required",
            "trackingDate.required"=>"Tracking date required",
            "tracking.required"=>"Tracking required",
            "timezone.required"=>"Timezone required",
            "hourLimit.required"=>"Hour Limit required",
        );
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

        }
    }

}
