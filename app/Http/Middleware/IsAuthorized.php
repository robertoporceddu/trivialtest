<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAuthorized
{
    public function handle($request, Closure $next, $guard = null)
    {
        if(
        	Auth::user()->role->name != 'admin' and (
        		request()->route()->getActionName() == 'App\Http\Controllers\UserController@store' or
	        	request()->route()->getActionName() == 'App\Http\Controllers\UserController@showAll' or
	        	(
	        		request()->route()->getActionName() == 'App\Http\Controllers\UserController@update' and
	        		Auth::user()->id != request()->route('user')->id
	        	) or
	        	(
	        		request()->route()->getActionName() == 'App\Http\Controllers\UserController@show' and
	        		Auth::user()->id != request()->route('user')->id
	        	)
        	)
        ) {
        	abort(401);
        }

        return $next($request);
    }
}
