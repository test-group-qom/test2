<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class midAuth
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
        $request->client = null;
        $token= $request-> header('token');
        if(!empty($token) && $user=\App\User::where('remember_token','=',$token)->get()->first())
        {
            if (!empty($user))
            {
                $request->client=$user;
                return $next($request);
            }
        }
        return Response::json('Access Denied!!',401);
    }
}
