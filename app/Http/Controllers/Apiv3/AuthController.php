<?php

namespace App\Http\Controllers\Apiv3;

use App\Http\Handlers\AuthHandler;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->handler = new AuthHandler();
        $this->handler->setMessage($this->message());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if($request->acceptsJson()){
            $data = $request->json()->all();
            $this->handler->login($data);
        }
        return $this->getResuft();
    }

    public function register(Request $request)
    {
        if($request->acceptsJson()){
            $data = $request->json()->all();
            $this->handler->register($data);
        }
        return $this->getResuft();
    }

}
