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
}