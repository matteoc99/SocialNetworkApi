<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class AdminAuth
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
        if(!$user->isAdmin)
            return response()->json(["error"=>"Admin only Route"],401);

        return $next($request);
    }
}
