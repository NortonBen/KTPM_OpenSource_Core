<?php

namespace App\Http\Handlers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use JWTAuth;

class AuthHandler extends Handler
{

    public  function login($data = array()){
        $validator = Validator::make($data, [
            "email" => "required|email",
            "password" => "required",
        ],$this->message);


        if ($validator->fails()) {
            $this->resuft = [ 'validator' => $validator->errors()];
            return $this->resuft;
        }

        if($token = JWTAuth::attempt($data)){
            $this->resuft =  [ 'success' => $token];
            return $this->resuft;
        }
        $this->resuft =  [ 'error' => 'tài khoản hoặc mật khẩu sai!'];
        return $this->resuft;
    }


    public  function register($data = array()){
        $validator = Validator::make($data,[
            "first_name"=>"required",
            "last_name"=>"required",
            'email' => 'required|email|max:255|unique:users',
            "password" => "required | between:6,20",
            "repassword" => "required | same:password",
            "sex"=> "required",
            "phone"=> "required | between:11,20",
            "birthday"=> "required",
            "description"=>"required",
            "address"=>"required",
            "company"=>"required",
            "relationships"=>"required",
            "phone_parent"=>"required | between:11,20"

        ],$this->message);

        if ($validator->fails()) {
            $this->resuft =  [ 'validator' => $validator->errors()];
            return $this->resuft;
        }
        $data['password'] = Hash::make($data['password']);

        if(User::create($data))
        {
            $this->resuft =  [ 'success' => 'true'];
            return $this->resuft;
        }
        $this->resuft =  [ 'error' => 'occur_error'];
        return $this->resuft;
    }
}
