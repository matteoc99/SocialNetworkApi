<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class EditorAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try{
            $user = auth()->userOrFail();
        }catch (UserNotDefinedException $exe){
            return response()->json(["error"=>$exe->getMessage()],401);
        }
        if(!$user->isEditor)
            return response()->json(["error"=>"Editor or above route"],401);

        return $next($request);    }
}
