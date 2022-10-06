<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;
use Auth;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
       public function list(){

        return view("admin.pages.users.list");
       }

       public function getList(Request $request){
        $data=User::orderBy("id","{$request->order}")->paginate(10);
        return response()->json([
            "message"=>"success",
            "code"=>200,
            "data"=>$data,
        ],200);
       }


       public function create(UserRequest $request){


            try{
                unset($request["_token"]);
                $request->request->add(['company_id'=>11]);
               if(User::check($request->email)){
                return response()->json([
                    "message"=>"Email already exists",
                    "code"=>200,
                ],200);
               }else{
                $insert=User::create($request->all());
                $data=user::paginate(10);
               if($insert){
                return response()->json([
                    "message"=>"success",
                    "code"=>200,
                    "data"=>$data,
                ],200);
               }else{

                return response()->json([
                    "message"=>"something is wrong try again",
                    "code"=>500,
                ],500);

               }
               }

            }
            catch(\Exception $e){
                return response()->json([
                    "message"=>$e->getMessage(),
                    "code"=>500,
                ]);
            }

       }

       public function status(Request $request){
        // print_r($request->all());
        // die;
          try{
            $update=User::where("id",$request->id)->update(['status'=>$request->status]);
            if($update){
                return response()->json([
                    "message"=>"success",
                    "code"=>200,
                ],200);
            }else{
                return response()->json([
                    "message"=>"Something is wrong try again",
                    "code"=>400,
                ],400);

            }

          }catch(\Exception $e){
            return response()->json([
                "message"=>$e->getMessage(),
                "code"=>500,
            ]);
        }
       }


       public function delete(Request $request){
             try{

                $delete=User::find($request->id)->delete();
                if($delete){
                    return response()->json([
                        "message"=>"success",
                        "status"=>200,
                    ],200);
                }else{
                    return response()->json([
                        "message"=>"Something is worng",
                        "status"=>200,
                    ],200);
                }

             }
             catch(\Exception $e){
                return response()->json([
                    "message"=>$e->getMessage(),
                    "status"=>500,
                ],500);
             }
       }


}
