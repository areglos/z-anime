<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminAPI
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
            return response()->json(['error' => 'Page not found'],404);
        }

        $user = Auth::user();
        if (!$user->hasRole($role)) {
            return response()->json(['error' => 'Denied Role Access'],404);
        }

        //return abort(404);
        return $next($request);
    }
}
