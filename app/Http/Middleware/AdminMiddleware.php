<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class AdminMiddleware
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
        $request->admin=null;
        $token=$request->header('token');
        $user = \App\User::where('remember_token',$token)->where('access',1);
        if(!empty($token) && $user->count() > 0)
        {
            $request->admin=$user->first();
            return $next($request);
        }
        return Response::json('Access Denied!',401);
    }
}
