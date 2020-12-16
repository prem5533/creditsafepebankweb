<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session::has('access_token'))
            return $next($request);
        if($request->ajax())
            return sendErrorResponse('Please login to continue');
        return redirect(route('login'))->with(['status'=>false,'message'=>'Please login to continue']);
    }
}
