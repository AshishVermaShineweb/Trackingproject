<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Gate;
use Validator;

class RoleController extends Controller
{
    function __contruct(){
        $this->middleware('role_or_permission:Role access|Role create|Role edit|Role delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Role create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Role edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Role delete', ['only' => ['destroy']]);
    }


    public function list(){

        return view("admin.pages.setting.roles.list");
    }

    public function listdata(Request $request){
        $data=Role::orderBy("id",$request->get("order"))->get();
       return response()->json($data);
    }


    public function add(Request $request){
       try{
        $validate=Validator::make($request->all(),
        ["role"=>"required"],
        ['role.required'=>"Role name can`t be empty"],

);
if($validate->fails()){
return response()->json([
"message"=>$validate->errors(),
"code"=>500,
],500);

}
else{
  $check=Role::where("name",$request->role)->exists();
  if($check){
    return response()->json([
        'message'=>"Role Already exists",
        "code"=>500,
       ],500);

  }else{
    $create=Role::create(['name'=>$request->role,"status"=>$request->status]);
    if($create){
        return response()->json([
            "message"=>"success",
            "code"=>200,
        ],200);

    }else{
       return response()->json([
        'message'=>"something  went wrong",
        "code"=>500,
       ],500);
    }
  }
}

       }
       catch(\Exception $e){
        return response()->json([
            "message"=>$e->getMessage(),
            "code"=>500,
        ],500);

       }
    }

    public function delete(Request $request){
        try{
            $id=$request->get("role_id");
        $role=Role::find($id);
        $delete=$role->delete();
        if($delete){
            return response()->json([
                "message"=>"success",
                "code"=>200,
            ],200);
        }else{
            return response()->json([
                "message"=>"Something went wrong trya again",
                "code"=>500,
            ],500);

        }

        }
        catch(\Exception $e){
            return response()->json([
                "message"=>$e->getMessage(),
                "code"=>500,
            ],500);

        }

    }

    //update role and permission
    public function update(Request $request){
        try{
            $validate=Validator::make($request->all(),[
                "role"=>"required",
            ],["role.required"=>"Role name can`t be empty"]);
            if($validate->fails()){
              return response()->json([
                "message"=>e->getMessage(),
                "code"=>400,
              ],400);
            }else{
                $update=Role::where("id",$request->id)->update(['name'=>$request->role,"status"=>$request->status]);
                if($update){
                    return response()->json([
                        "message"=>"success",
                        "code"=>200,
                    ],200);
                }else{
                    return response()->json([
                        "message"=>"something went wrong",
                        "code"=>400,
                    ],400);
                }

            }


        }catch(\Exception $e){
            return response()->json([
                "message"=>$e->getMessage(),
                "code"=>500,
            ],500);
        }
    }
}
