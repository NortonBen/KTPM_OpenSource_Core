<?php

namespace App\Http\Middleware\V2;

use Closure;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class JWTMiddleware extends BaseMiddleware
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
        if (! $token = $this->auth->setRequest($request)->getToken()) {
            return response()->json(
                [
                    "status" => "error",
                    "data" => null,
                    "message" =>'token_not_provided'
                ]
                ,200);
        }

        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {

            return response()->json(
                [
                    "status" => "error",
                    "data" => null,
                    "message" =>'token_expired'
                ]
                ,200);
        } catch (JWTException $e) {

            return response()->json(
                [
                    "status" => "error",
                    "data" => null,
                    "message" =>'token_invalid'
                ]
                ,200);
        }

        if (! $user) {
            return response()->json(
                [
                    "status" => "error",
                    "data" => null,
                    "message" =>'user_not_found'
                ]
                ,404);

        }

        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}
