<?php

namespace App\Http\Middleware;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            JWTAuth::parseToken()->authenticate();
        }
        catch(Exception $e){
            if($e instanceof TokenInvalidException){
                return response()->json(['status'=> 'invalid token'],400);
            }
            if($e instanceof TokenExpiredException){
                return response()->json(['status'=> 'expired token'],401);
            }

            return response()->json(['status'=> 'token not fount'],400);

        }
        return $next($request);
    }
}