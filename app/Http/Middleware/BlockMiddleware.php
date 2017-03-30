<?php

namespace App\Http\Middleware;

use Closure;
use Lcobucci\JWT\Parser;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class BlockMiddleware extends BaseMiddleware
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
        $token = (new Parser())->parse((string) $token); // Parses from a string
        if($token->getClaim('iss') == 'token_check_time_out'){
            return response()->json(
                [
                    "status" => "error",
                    "data" => null,
                    "message" =>'token_not_access'
                ]
                ,200);
        }
        return $next($request);
    }
}
