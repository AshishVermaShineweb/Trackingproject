<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Validator;
use Auth;
use App\Models\TrackerInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class ProjectController extends Controller
{
    public function list(){
        $data=Project::latest()->paginate(15);
        return view("admin.pages.project.list",['data'=>$data]);
    }

    public function add(){
        $user=User::where("active","=",1)->where("name","!=","Admin")->get();
        return view("admin.pages.project.add",['user'=>$user]);
    }

    public function store(Request $request){
        try{
            $rule=array(

                "project-name"=>"required|unique:projects,name",
                "user_id"=>"exists:users,id",
                "active"=>"in:1,0",

            );

            $message=array(
                "project-name.required"=>"Project can`t be empty",
                "user_id.exists"=>"Select user",
                "active.in"=>"Select Active",
                "project-name.unique"=>"Project name can`t be duplicate",
            );

            $validator=Validator::make($request->all(),$rule,$message);
            if($validator->fails()){
              return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
            }
            else{
                  $check=Project::where("name","=",$request->get("project-name"))->count();
                  if($check>0){
                    return redirect()->back()->with(['wrong_status'=>"wrong","message"=>"Project name is already exist"])->withInput($request->all());
                  }
                  else{
                    $request->request->add(['company_id'=>1]);
                    $request->request->add(['name'=>$request->get("project-name")]);

                    $create=Project::create($request->all());
                    if($create){
                        return redirect()->back()->with(['success_status'=>"success","message"=>"Project Created Succssfully"]);
                    }
                    else{
                        return redirect()->back()->with(['wrong_status'=>"wrong","message"=>"Something is wrong try again"]);
                    }
                  }
            }


        }
        catch(\Exception $e){
            return redirect()->back()->with(['wrong_status'=>"wrong","message"=>$e->getMessage()]);

        }
    }

public function delete($id=null){
    $id=Crypt::decrypt($id);
    try{
        $check=Project::find($id)->delete();
        if($check){
            return redirect()->back()->with(['success_status'=>"success","message"=>"Project deleted successfully"]);
        }
        else{
            return redirect()->back()->with(['wrong_status'=>"success","message"=>"Something is wrong"]);
        }

    }
    catch(\Exception $e){
        return redirect()->back()->with(["wrong_status"=>"error","message"=>$e->getMessage()]);
    }
}



public function edit($id=null){
    try{
        try {
            $id = Crypt::decrypt($id);
            $data=Project::find($id)->toArray();
            $user=User::where("active","=",1)->where("name","!=","Admin")->get();
            return view("admin.pages.project.edit",['data'=>$data,"user"=>$user]);

        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->back()->with(['wrong_status'=>"wrong","message"=>$e->getMessage()]);
        }

    }
    catch(\Exception $e){
       return redirect()->back()->with(['wrong_status'=>"wrong","message"=>$e->getMessage()]);
    }
}

public function update(Request $request){
    try{
      $rule=array(
          "project-name"=>"required",
          "user_id"=>"exists:users,id",
          "active"=>"in:1,0"
         );
         $message=array(
            "project-name.required"=>"Project name can`t be empty",
            "user_id.exists"=>"Select User",
            "active.in"=>"Select active",

         );
         $validator=Validator::make($request->all(),$rule,$message);
         if($validator->fails()){
            return redirect()->back()->with(['wrong_status'=>"wrong","message"=>"All filed is required"])->withInput($request->all())->withErrors($validator->errors());

         }else{
            $check=Project::where("name","=",$request->input("project-name"))->count();

            if($check<=1){
                $project=Project::find($request->id);
                $request->request->add(['name'=>$request->get("project-name")]);
                $update=$project->update($request->all());
            if($update){

                return redirect("/company/project")->with(['success_status'=>"success","message"=>"Project Updated Successfully"]);

            }
            else{
                return redirect("/company/project")->with(['wrong_status'=>"wrong","message"=>"Something is wrong try again"]);

            }

            }else{
                return redirect()->back()->with(['wrong_status'=>"wrong","message"=>"Project Name is already exists"])->withInput($request->all());


            }
         }

    }catch(\Illuminate\Database\QueryException $e){
        return redirect("/company/project")->with(['wrong_status'=>"wrong","message"=>$e->errorInfo[1]==1062 ? "Duplicate entry not allow":"Something is wrong try again"]);

    }

}



  //get project listing on behalf is user assigned project
  public function getProjectListAssignedUser(Request $request,$id=null){
       if(isset($id)){
        $start_date=Carbon::now()->startOfWeek()->format("Y-m-d");
        $end_date=Carbon::now()->endOfWeek()->format("Y-m-d");
        $allProject=Project::select("name","description","hourLimit","active","id","user_id")->where("user_id",$id)->get();
        foreach($allProject as $key=> $project_list){
            $check=TrackerInfo::where("user_id",$id)
                             ->where("project_id",$project_list->id)
                             ->whereBetween("trackingDate",[$start_date,$end_date])
                             ->sum("trackingHours");
                if($check>0){
                    $allProject[$key]['trackingHours']=$check;
                }else{
                    $allProject[$key]['trackingHours']=0;
                }
        }


        return view("admin.pages.tracker.assignedProject",['data'=>$allProject]);

       }

  }

}
