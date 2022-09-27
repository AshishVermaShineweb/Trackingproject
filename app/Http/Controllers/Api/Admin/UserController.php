<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User,Company};
use Validator;
use Auth;
use Hash;

class UserController extends Controller
{

    function __construct(){
        $this->middleware('auth:api', ['except' => ['login']]);
    }




    public function login(Request $request)
    {

        $rule=[
            'email'=>"required",
            "password"=>"required",
        ];
        $custom_message=[

            'email.required'=>"Email can`t be empty",
            'password.required'=>"Password can`t be empty",
        ];
        $validate=Validator::make($request->all(),$rule,$custom_message);
        if($validate->fails()){
            return response()->json(

                [
                    'message'=>$validate->errors()->first(),
                    "error"=>$validate->errors(),
                    "status"=>"error",
                ]
            );
        }
        else{
            $user=User::where("email",$request->email)->first();
            if($user){

                if(Hash::check($request->password, $user->password)){
                    $token = $user->createToken("token");
                    $user=User::where("email",$request->email)->first();

                    return ['token' => $token->plainTextToken,
                    "message"=>"success",
                    "status"=>200,
                    "user"=>$user,


                ];

                }
                else{
                    return response()->json(
                        [
                            "message"=>"Password wrong",
                            "status"=>"error",


                        ]


                    );

                }


            }
            else{
                return response()->json(
                    [
                        "message"=>"Email not exist",
                        "status"=>"error",


                    ]


                );

            }
        }




    }

    public function logout(Request $request){
        $check=$request->user()->currentAccessToken()->delete();
        if($check){
            return response()->json(
                [
                    'message'=>"successfully logout",
                    "status"=>200,
                ]
            );
        }

    }
    public function forgetpassword(Request $request){
    $validate=Validator::make($request->all(),
    [
        'email'=>"required",
        "new_password"=>"required",
    ],
    [
        'email.required'=>"Email can`t be empty",
        "new_password.required"=>"New Password can`t be empty",
    ]

    );

    if($validate->fails()){
        return response()->json(

            [
                'message'=>$validate->errors()->first(),
                "status"=>"error",
                "error"=>$validate->errors(),
            ]
        );
    }
    else{
        $user=User::where("email",$request->email)->first();
        if($user){
            $update=$user->update(['password'=>Hash::make($request->password)]);
            if($update){
                return response()->json(

                    [
                        'message'=>"Password Change Successfully",
                        "status"=>200,
                    ]
                );
            }





        }
        else{
            return response()->json(

                [
                    'message'=>"Email not exist",
                    "status"=>"error",
                ]
            );

        }
    }
    }

    public function change_password(Request $request){
        try{
            $rule=array(

                "email"=>"required",
                "old_password"=>"required",
                "new_password"=>"required",

            );
            $custom_message=array(
                 "email.required"=>"Email can`t be empty",
                 "old_password.required"=>"Old password can`t be empty",
                 "new_password.required"=>"New password can`t be empty",

            );
            $validate=Validator::make($request->all(),$rule,$custom_message);
            if($validate->fails()){
                return response()->json(
                    [
                        'message'=>$validate->errors()->first(),
                        "status"=>"error",
                        "error"=>($validate->errors()),
                    ]
                );
            }
            else{
                $user=User::where("email",$request->email)->first();
                if($user){
                    if(Hash::check($request->old_password,$user->password)){
                        $check=$user->update(['password'=>Hash::make($request->new_password)]);
                        if($check){
                            return response()->json(
                                [
                                    'message'=>"Successfully password change",
                                    "status"=>200,
                                ]
                            );
                        }
                        else{
                            return response()->json(
                                [
                                    'message'=>"something is wrong try again",
                                    "status"=>"error",
                                ]
                            );
                        }

                    }
                    else{

                        return response()->json(

                            [
                                'message'=>"Old password wrong",
                                "status"=>"error",
                            ]
                        );
                    }

                }else{
                    return response()->json(

                        [
                            'message'=>"Email not exist",
                            "status"=>"error",
                        ]
                    );
                }

            }

        }
        catch(\Throwable $e){
            return response()->json(
                [
                    'message'=>$e,
                    "status"=>"error",
                ]
            );

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)

    {
        try{
            $rule=array(
                "name"=>"required",
                "email"=>"required|email",
                "company_id"=>"required",
                "password"=>"required",
                "username"=>"required",
                "timezone"=>"required",
            );

            $message=array(
                "name.required"=>"Name can`t be empty",
                "email.required"=>"Email can`t be empty",
                "email.email"=>"Email format is invalid",
                "company_id.required"=>"Select Company Name",
                "password.required"=>"Password can`t be empty",
                "username.required"=>"Username can`t be empty",
                "timezone.required"=>"Timezone can`t be empty",
            );

            $validate=Validator::make($request->all(),$rule,$message);
            if($validate->fails()){
                return response()->json([
                    'message'=>$validate->errors()->first(),
                    "status"=>"error",
                    "error"=>$validate->errors()->all(),
                ]);
            }
            else{
                $check=User::where("email",$request->email)->exists();
                if($check){
                    return response()->josn([
                        'message'=>"Email alredy exists",
                        "status"=>"error",

                    ],409);
                }
                else{
                    $token=Hash::make(\Str::random(20));
                    $request->request->add(['token'=>$token]);
                    $request->request->add(['loginip',$request->ip()]);
                    $request->request->add(['role'=>2]);
                    $request->request->add(['password'=>Hash::make($request->password)]);
                    $user=Users::create($request->all());
                    if($user){
                        $token = $user->createToken("token");
                        return response()->json([
                            'message'=>"Successfully register",
                            "status"=>200,
                            "user"=>$user,

                        ],200);
                    }
                    else{
                        return response()->json([
                            'message'=>"Something is wrong try again",
                            "status"=>"error",
                        ],500);
                    }
                }
            }

        }
        catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage(),
                "status"=>"error",
            ],500);

        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
