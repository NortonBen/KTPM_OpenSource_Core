<?php

namespace App\Http\Controllers\ApiV2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    protected function api_response($data = null){
        return response()->json([
            "status" => "success",
            "data" => $data,
            "message" => null
        ],200);
    }

    /*
     *  @param $data
     *
     */
    protected function api_response_error($data = null){
        return response()->json([
            "status" => "error",
            "data" => [],
            "message" => $data
        ],200);
    }

    protected  function message(){
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
