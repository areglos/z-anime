<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {   
        if (!Auth::check()) {
            return response()->view('theme.pages.404');
        }

        $user = Auth::user();
        if (!$user->hasRole($role)) {
            return response()->view('theme.pages.404');
        }

        //return abort(404);
        return $next($request);
    }
}
