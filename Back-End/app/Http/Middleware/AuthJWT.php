<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTAuthException;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class AuthJWT extends BaseMiddleware {


    public function handle($request, \Closure $next) {

        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {

                $response['status']  = 7;
                $response['message'] = "The token is correct but user has been deleted";
                return response()->json($response,401); 

            }
            
            if($user = JWTAuth::parseToken()->authenticate() && $user->is_blocked == 1) {
                
                $response['status']  = 2;
                $response['message'] = "This user has been blocked from App";
                return response()->json($response,401);

            }

        }catch (TokenExpiredException $e) {
        
            $response['status']  = 3;
            $response['message'] = "token expired";
            return response()->json($response,401); 

        }catch (TokenInvalidException $e) {
            
            $response['status']  = 4;
            $response['message'] = "token invalid";
            return response()->json($response,401); 

        }catch(JWTAuthException $e){
            
            $response['status']  = 6;
            $response['message'] = "unexpected error";
            return response()->json($response,401); 

        }catch(JWTException $e){

            $response['status']  = 5;
            $response['message'] = "token required";
            return response()->json($response,401); 

        }

        return $next($request);

    }
    

}