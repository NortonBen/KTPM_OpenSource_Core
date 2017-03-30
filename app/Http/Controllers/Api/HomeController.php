<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class HomeController extends Controller
{
    public function check(){
        $data = Carbon::now();
        $now = $data->timestamp;
        //$payload = JWTFactory::sub(['created_at' => $now->toDateTimeString(), 'time' => 30])->make();
        $payload = JWTFactory::make([
            'iss' => 'token_check_time_out',
            'iat' => $now,
            'exp' => $now + 300,
            'nbf' => $now,
            'sub' => -1,
            'jti' => md5('1'.$now)
        ]);
        $token = JWTAuth::encode($payload);
        return $this->api_response([
            'token' => $token->get()
        ]);
    }

    public  function  test(Request $request,$part = 30){
        $user = DB::table("users");
        if($request->has("search")){
            $user->where("first_name","like",'%'.$request->get("search").'%');
            $user->orwhere("last_name","like",'%'.$request->get("search").'%');
            $user->orwhere("phone","like",'%'.$request->get("search").'%');
            $user->orwhere("address","like",'%'.$request->get("search").'%');
            $user->orwhere("description","like",'%'.$request->get("search").'%');
        }

        if($request->has("order_by")){
            $order = $request->get("order_by");
            if($order == 1){ // name
                $user->orderBy("first_name");
            }
            if($order == 2){ // birthday
                $user->orderBy("birthday");
            }
        }
        $data  = $user->select( "id", "first_name", "last_name", "email", "sex", "phone","birthday", "description","address","company","relationships","phone_parent")->simplePaginate($part);
        //$data = User::all();
        return $this->api_response([
            'users' => $data
        ]);
    }
}
