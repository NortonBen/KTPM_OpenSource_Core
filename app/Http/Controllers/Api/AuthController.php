<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class AuthController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required",
        ],$this->message());


        if ($validator->fails()) {
            return $this->api_response_error([ 'validator' => $validator->errors()]);
        }
        $data  = $request->only(['email','password']);

        if($token = JWTAuth::attempt($data)){
            return $this->api_response([
               'token' => $token
            ]);
        }
        return $this->api_response_error([ 'message' => ['Tài khoản hoặc mật khẩu không chính xác!']]);
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
           "first_name"=>"required",
            "last_name"=>"required",
            "email"=>"required | email",
            "password" => "required | between:6,20",
            "repassword" => "required | same:password",
            "sex"=> "required",
            "phone"=> "required",
            "birthday"=> "required",
            "description"=>"required",
            "address"=>"required",
            "company"=>"required",
            "relationships"=>"required",
            "phone_parent"=>"required"

        ],$this->message());
        if ($validator->fails()) {
            return $this->api_response_error([ 'validator' => $validator->errors()]);
        }
        $data = $request->only(['first_name','last_name','email','password','repassword','sex','phone','birthday','description','address','company','relationships','phone_parent']);
        if(User::create($data))
        {
            return $this->api_response([
                'message' => 'Thêm thành công'
            ]);
        }
        return $this->api_response_error([
           'message'=>'Thêm thất bại'
        ]);

    }


    private  function message(){
        $messages = [
            'same'    => 'The :attribute and :other must match.',
            'size'    => 'The :attribute must be exactly :size.',
            'between' => 'The :attribute must be between :min - :max.',
            'in'      => 'The :attribute must be one of the following types: :values',
            'repassword.same'    => 'Nhập mật khẩu chưa đúng',
            'required' => 'Bạn chưa nhập :attribute',
            'email' => 'Hãy nhập nhập đia chỉ email!'
        ];
        return $messages;
    }

}
