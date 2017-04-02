<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
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
        ($request->client = null);
        $token= $request-> header('token');
        $user=\App\User::where('token','=',$token)->get()->first();
        if(!empty($token) && $user )
        {
            if ($user->count())
            {
                $request->client=$user;
                return $next($request);
            }
        }
        else
            return Response::json('Access Denied!!',401);
    }
}
