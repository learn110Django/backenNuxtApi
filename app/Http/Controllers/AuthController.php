<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\User  as UserResource;
class AuthController extends Controller
{
    public function register(UserRegisterRequest $request){

       $user=User::create([
         'email'=>$request->email,
          'name'=>$request->name,
         'password'=>bcrypt($request->password),
       ]);

       if(!$token =auth()->attempt($request->only(['email','password']))){
            return abort(401);
       }

       return (new UserResource($request->user()))->additional([
         'meta'=>[
          'token'=>$token
         ],
       ]);
    }

    public function login(UserLoginRequest $request){
            if(!$token =auth()->attempt($request->only(['email','password']))){
                        return response()->json([
                           'errors'=>[
                              'email'=>['Sorry the email or password field not match ']
                           ],
                        ],422);
                   }

                  return (new UserResource($request->user()))->additional([
                     'meta'=>[
                      'token'=>$token
                     ],
                   ]);


                  /*  return response()->json(
                        (new UserResource($request->user()))->additional([
                               'token'=>$token
                         ])
                    , 200);
                    */
    }

    	public function user(Request $request) {
    		return new UserResource($request->user());
    	}


    public function logout(){
       auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
}
