<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;
use Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
        public function userList(){
            $data=User::select("name","email","timezone","id")->get();

            return view("admin.pages.tracker.list",['data'=>$data]);
        }


        public function add(){

            return view("admin.pages.user.add");
        }

        public function store(Request $request){
            try{
                $rule=array(

                    "name"=>"required",
                    "username"=>"required",
                    "email"=>"required",
                    "password"=>"required",
                    "timezone"=>"required",
                    "active"=>"in:1,0",

                );

                $message=array(
                    "name.required"=>"Name can`t be empty",
                    "username.required"=>"Username can`t be empty",
                    "email.required"=>"Email can`t be empty",
                    "password.required"=>"Password  can`t be empty",
                    "timezone.required"=>"Timezone can`t be empty",
                    "active.in"=>"Select Active",
                );

                $validator=Validator::make($request->all(),$rule,$message);
                if($validator->fails()){
                  return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
                }
                else{
                      $check=User::where("email","=",$request->get("email"))->count();
                      if($check>0){
                        return redirect()->back()->with(['wrong_status'=>"wrong","message"=>"Project name is already exist"])->withInput($request->all());
                      }
                      else{
                        $request->request->add(['company_id'=>1]);
                        $token=Hash::make(\Str::random(20));
                        $loginip=$request->ip();
                        $password=Hash::make($request->password);
                        $request->request->add(['token'=>$token,"loginip"=>$loginip,"password"=>$password,"role"=>2]);


                        $create=User::create($request->all());
                        if($create){
                            return redirect()->back()->with(['success_status'=>"success","message"=>"User Register Succssfully"]);
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
            $check=User::find($id)->delete();
            if($check){
                return redirect()->back()->with(['success_status'=>"success","message"=>"User deleted successfully"]);
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
                $data=User::find($id)->toArray();

                return view("admin.pages.user.edit",['data'=>$data]);

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

                "name"=>"required",
                "username"=>"required",
                "email"=>"required|email",
                "timezone"=>"required",
                "active"=>"in:1,0",

            );

            $message=array(
                "name.required"=>"Name can`t be empty",
                "username.required"=>"Username can`t be empty",
                "email.required"=>"Email can`t be empty",
                "email.email"=>"Email format is invalid",
                "timezone.required"=>"Timezone can`t be empty",
                "active.in"=>"Select Active",
            );
             $validator=Validator::make($request->all(),$rule,$message);
             if($validator->fails()){
                return redirect()->back()->with(['wrong_status'=>"wrong","message"=>$validator->errors()->first()])->withInput($request->all())->withErrors($validator->errors());

             }else{
                $check=User::where("email","=",$request->input("email"))->count();

                if($check<=1){
                    $user=User::find($request->id);
                    $request->request->add(['loginip'=>$request->ip()]);
                    $update=$user->update($request->all());
                if($update){

                    return redirect("/company/users")->with(['success_status'=>"success","message"=>"User Details Updated Successfully"]);

                }
                else{
                    return redirect("/company/users")->with(['wrong_status'=>"wrong","message"=>"Something is wrong try again"]);

                }

                }else{
                    return redirect()->back()->with(['wrong_status'=>"wrong","message"=>"Email Name is already exists"])->withInput($request->all());


                }
             }

        }catch(\Illuminate\Database\QueryException $e){
            return redirect("/company/users")->with(['wrong_status'=>"wrong","message"=>$e->errorInfo[1]==1062 ? "Duplicate entry not allow":"Something is wrong try again"]);

        }

    }
}
