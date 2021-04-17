<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        // return $next($request);
        if (in_array($request->user()->role, $levels)) {
            return $next($request);
        }
        return redirect('/login')->with('error', "Error");
    }
}
