<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $details = $request->only(["email","password"]);

        if(!$token = Auth::attempt($details)){
            return response()->json(['error'=>'incorrect email or password'],401);
        }

        return response()->json(["token"=>$token]);
    }

    public function refresh(){

        $token = Auth::refresh();

        return response()->json(["token"=>$token]);
    }
    public function register(Request $request){

        $request->validate([
            "name" => "required",
            'email' => "required",
            "password" => "required",
            "lat" => "required",
            "lng" => "required",
        ]);

        $details = $request->only(["email","password"]);

        $user = new User();
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->password = bcrypt($request->get("password"));
        $user->lat = $request->get("lat");
        $user->lng = $request->get("lng");

        $user->save();

       $token = Auth::attempt($details);

        return response()->json(["token"=>$token]);
    }
}
