<?php

namespace App\Http\Controllers\Apiv3;

use App\Caption;
use App\Http\Handlers\CaptionHandler;
use Illuminate\Http\Request;

class CaptionController extends Controller
{
    public function __construct()
    {
        $this->handler = new CaptionHandler();
        $this->handler->setMessage($this->message());
    }

    public function index(Request $request){

        $data = $request->only(['order_by','part','search']);
        $this->handler->index($data);
        return $this->getResuft();
    }

    public function store(Request $request,Caption $caption){
        if($request->acceptsJson()){
            $data = $request->json()->all();
            $this->handler->store($data);
        }
        return $this->getResuft();
    }

    public function update(Caption $caption,Request $request){
        if($request->acceptsJson()){
            $data = $request->json()->all();
            $this->handler->update($data,$caption);
        }
        return $this->getResuft();
    }

    public function destroy(Caption $caption){
        $this->handler->destroy($caption);
        return $this->getResuft();
    }

    public function show(Caption $caption){
        $this->handler->show($caption);
        return $this->getResuft();
    }

}
