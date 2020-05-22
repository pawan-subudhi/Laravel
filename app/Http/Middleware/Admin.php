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
    public function handle($request, Closure $next)
    {
        //pluck gets the value from the array by key 
        $adminRole = Auth::user()->roles()->pluck('name');
        //contains checks with the value is same or not i.e here adminRole is having admin value or not
        if($adminRole->contains('admin')){
            return $next($request);
        }
    }
}
