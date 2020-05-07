<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        $details = $request->only(["email","password"]);

        $token = auth()->attempt($details);

        return $token;
    }
}
