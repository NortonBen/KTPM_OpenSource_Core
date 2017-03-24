<?php
/**
 * Created by PhpStorm.
 * User: wind
 * Date: 14/03/2017
 * Time: 10:18 SA
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Contracts\Validation\Validator;

class Controller extends BaseController
{
    protected function api_response($data = array()){
        return response()->json([
            "success" => $data
        ],200);
    }

    /*
     *  @param $data
     *
     */
    protected function api_response_error($data = array()){
        return response()->json([
            'error' => $data
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