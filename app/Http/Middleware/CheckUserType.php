<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $userType)
    {
        $userTypes = [
            'admin' => [1,2,3,4,5,6],
            'user' => [0],
        ];
            if (!in_array(auth()->user()->user_type_id, $userTypes[$userType])) {
                abort(403);
            }
            return $next($request);
    }
}
