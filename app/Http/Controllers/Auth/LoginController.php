<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class LoginController extends Controller
{
    public function loginRequired(Request $request){

        return response()->json(['error'=>'something went wrong xD'],401);

    }

    public function login(Request $request){
        $details = $request->only(["email","password"]);

        if(!$token = Auth::attempt($details)){
            return response()->json(['error'=>'incorrect email or password'],401);
        }

        return response()->json(["token"=>$token]);
    }

    public function refresh(){
        try{
            $token = Auth::refresh();

        }catch (TokenInvalidException $e){
            return response()->json(["error"=>$e->getMessage()],401);
        }

        return response()->json(["token"=>$token]);
    }
    public function register(Request $request){

        $request->validate([
            "name" => "required",
            'email' => "required",
            "password" => "required",
        ]);

        $details = $request->only(["email","password"]);

        $user = new User();
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->password = bcrypt($request->get("password"));

        $user->save();

       $token = Auth::attempt($details);

        return response()->json(["token"=>$token]);
    }
}
