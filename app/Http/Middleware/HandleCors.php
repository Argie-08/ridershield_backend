<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleCors
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
        // CORS headers
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')  // Allow all origins (you can replace '*' with your frontend URL for better security)
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')  // Allowed methods
            ->header('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Authorization, Origin')  // Allowed headers
            ->header('Access-Control-Max-Age', '1728000');  // Cache the CORS response for 20 days
    }
}


// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;

// class HandleCors
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure  $next
//      * @return mixed
//      */

//     public function handle(Request $request, Closure $next)
//     {
       
//         return $next($request)
//             ->header('Access-Control-Allow-Origin', '*')  // Allows all origins (change '*' to your frontend URL for better security)
//             ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')  // Allowed methods
//             ->header('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Authorization, Origin');  // Allowed headers
//     }
// }
