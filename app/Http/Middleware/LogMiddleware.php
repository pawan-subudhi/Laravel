<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\File;

class LogMiddleware
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
        if(env('APP_DEBUG_LOG')){
            File::append(
                storage_path('logs/request.log'),
                $request.PHP_EOL
            );
        }
        return $next($request);
    }

    // public function terminate($request, $response)
    // {
    //     if(env('APP_DEBUG_LOG')){
    //         File::append(
    //             storage_path('logs/request.log'),
    //             $request.PHP_EOL
    //         );
    //         File::append(
    //             storage_path('logs/response.log'),
    //             $response.PHP_EOL
    //         );
    //     }
    // }
}


