<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        //$this->checkToken();
    }

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
        ], $this->message());


        if ($validator->fails()) {
            return $this->api_response_error(['validator' => $validator->errors()]);
        }
        $data = $request->only(['email', 'password']);

        if ($token = JWTAuth::attempt($data)) {
            return $this->api_response([
                'token' => $token
            ]);
        }
        return $this->api_response_error(['message' => ['Tài khoản hoặc mật khẩu không chính xác!']]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name" => "required",
            "last_name" => "required",
            "email" => 'required | unique:users,email',
            "password" => "required | between:6,20",
            "repassword" => "required | same:password",
            "sex" => "required",
            "phone" => "required | between:11,20",
            "birthday" => "required",
            "description" => "required",
            "address" => "required",
            "company" => "required",
            "relationships" => "required",
            "phone_parent" => "required | between:11,20 "

        ], $this->message());
        if ($validator->fails()) {
            return $this->api_response_error(['validator' => $validator->errors()]);
        }
        //$data = $request->all();
        $data = $request->only(['first_name', 'last_name', 'email', 'password', 'repassword', 'sex', 'phone', 'birthday', 'description', 'address', 'company', 'relationships', 'phone_parent']);
        $data['password'] = Hash::make($data['password']);

        if ($validator->fails()) {
            return $this->api_response_error(['validator' => $validator->errors()]);
        }
        if (User::create($data)) {

            return $this->api_response([
                'message' => 'Thêm thành công'
            ]);
        }
        return $this->api_response_error([
            'message' => 'Thêm thất bại'
        ]);
    }

}
