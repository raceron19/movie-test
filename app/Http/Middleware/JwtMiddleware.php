<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JwtMiddleware
{
    
    public function handle($request, Closure $next)
    {
        try {
            //token verification
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            //invalid token
            if ($e instanceof TokenInvalidException){
                return response()->json(
                    ['error' => [
                        'status' => '400',
                        'title' => 'Invalid token',
                        'detail' => 'The token given it\'s invalid.'
                    ],
                ], 400);
            }
            //token is expired
            else if ($e instanceof TokenExpiredException){
                return response()->json(
                    ['error' => [
                        'status' => '400',
                        'title' => 'Token Expired',
                        'detail' => 'The token given it\'s expired.'
                    ]
                ], 400);
            }
            //not logged user
            else{
                return response()->json(
                    ['error' => [
                        'status' => '400',
                        'title' => 'Token not found',
                        'detail' => 'Authorization token not found.'
                    ]
                ], 400);
            }
        }
        return $next($request);
    }
}
