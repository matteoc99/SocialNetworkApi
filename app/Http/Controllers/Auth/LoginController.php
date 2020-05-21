<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

/**
 * @group Authentication
 *
 * endpoints for everything related to authentication
 */

class LoginController extends Controller
{

    /**
     * Authentication Middleware
     * Route that gets called if authentication failed
     */
    public function loginRequired(Request $request){

        return response()->json(['error'=>'no token was provided, it expired, or the route requires admin rights'],401);

    }


    /**
     * Login
     * @bodyParam email string required
     * @bodyParam password string required
     */
    public function login(Request $request){
        $details = $request->only(["email","password"]);

        if(!$token = Auth::attempt($details)){
            return response()->json(['error'=>'incorrect email or password'],401);
        }

        return response()->json(["token"=>$token]);
    }
    /**
     * Token Refresh
     * Refresh JWT Token before it expires
     */
    public function refresh(){
        try{
            $token = Auth::refresh();

        }catch (TokenInvalidException $e){
            return response()->json(["error"=>$e->getMessage()],401);
        }

        return response()->json(["token"=>$token]);
    }

    /**
     * Register
     * @bodyParam name string required
     * @bodyParam email string required
     * @bodyParam password string required
     */
    public function register(Request $request){

        $request->validate([
            "name" => "required",
            'email' => "required|email",
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
