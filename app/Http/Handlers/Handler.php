<?php
/**
 * Created by PhpStorm.
 * User: wind
 * Date: 09/04/2017
 * Time: 8:12 CH
 */

namespace App\Http\Handlers;


class Handler
{
    protected $resuft = [];
    protected $message = [];
    protected $data  = [];

    public function setMessage($message = array()){
        $this->message  = $message;
    }

    public function setData($data = array()){
        $this->data  = $data;
    }

    public function has($name){
        return isset($this->data[$name]);
    }

    public function get($name){
        return $this->data[$name];
    }

    public function isValidator(){
        return isset($this->resuft['validator']);
    }

    public function getValidator(){
        return $this->resuft['validator'];
    }

    public function isSuccess(){
        return isset($this->resuft['success']);
    }

    public function getSuccess(){
        return $this->resuft['success'];
    }

    public function isError(){
        return isset($this->resuft['error']);
    }

    public function getError(){
        return $this->resuft['error'];
    }

}