<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminRoleMiddleware
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
        if(auth()->user()->admin)
        {
            return $next($request);
        }
        return response()->json(
            ['error' => [
                'status' => '403',
                'title' => 'Forbidden',
                'detail' => 'User not authorize for this action.'
            ]
        ], 403);
    }
}
