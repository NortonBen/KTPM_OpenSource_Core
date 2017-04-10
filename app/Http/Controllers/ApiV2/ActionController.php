<?php

namespace App\Http\Controllers\ApiV2;

use App\Caption;
use App\Http\Handlers\ActionHandler;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function __construct(Request $request)
    {
        $this->handler = new ActionHandler();
        $this->handler->setMessage($this->message());

    }

    public function index(Request $request, Caption $caption)
    {
        $data = $request->only(['type','part']);
        $this->handler->index($caption,$data);
        return $this->getResuft();
    }

    public function store(Request $request, Caption $caption)
    {

        $data = $request->all();
        $this->handler->store($caption, $data);

        return $this->getResuft();
    }

    public function destroy(Caption $caption)
    {
        $this->handler->destroy($caption);
        return $this->getResuft();
    }
}
