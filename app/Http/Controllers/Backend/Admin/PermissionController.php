<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class PermissionController extends Controller
{
    function __construct()
    {
        // $this->middleware('role_or_permission:Permission access|Permission create|Permission edit|Permission delete', ['only' => ['index','show']]);
        // $this->middleware('role_or_permission:Permission create', ['only' => ['create','store']]);
        // $this->middleware('role_or_permission:Permission edit', ['only' => ['edit','update']]);
        // $this->middleware('role_or_permission:Permission delete', ['only' => ['destroy']]);
    }

    public function list(){
        $role=Role::where("status",1)->get();
        return view("admin.pages.setting.permission.list",['role'=>$role]);
    }

    public function listdata(Request $request){
        $data=Permission::orderBy("id",$request->get("order"))->get();
       return response()->json($data);
    }


    public function add(Request $request){
       try{
        $validate=Validator::make($request->all(),
        ["permission"=>"required"],
        ['permission.required'=>"Permission name can`t be empty"],

);
if($validate->fails()){
return response()->json([
"message"=>$validate->errors(),
"code"=>500,
],500);

}
else{
  $check=Permission::where("name",$request->permission)->exists();
  if($check){
    return response()->json([
        'message'=>"Permission Already exists",
        "code"=>500,
       ],500);

  }else{
    $create=Permission::create(['name'=>$request->permission,"status"=>$request->status]);
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
            $id=$request->get("permission_id");
        $permission=Permission::find($id);
        $delete=$permission->delete();
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
            $update=Permission::where("module_name",$request->get("module_name"))->update(["{$request->get('column_name')}"=>$request->status]);
            try{
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
            catch(\Throwable $e){
                return response()->json([
                    "message"=>$e->getMessage(),
                    "code"=>500,
                ]);
            }

        }catch(\Exception $e){
            return response()->json([
                "message"=>$e->getMessage(),
                "code"=>500,
            ],500);
        }
    }

}
