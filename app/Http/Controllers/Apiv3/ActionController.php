<?php

namespace App\Http\Controllers\Apiv3;

use App\Caption;
use App\Http\Handlers\ActionHandler;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function __construct()
    {
        $this->handler = new ActionHandler();
        $this->handler->setMessage($this->message());
    }

    public function index(Request $request, Caption $caption)
    {
        if ($request->acceptsJson()) {
            $data = $request->json()->all();
            $this->handler->index($data, $caption);
        }
        return $this->getResuft();
    }

    public function store(Request $request, Caption $caption)
    {
        if ($request->acceptsJson()) {
            $data = $request->json()->all();
            $this->handler->store($caption, $data);
        }
        return $this->getResuft();
    }

    public function destroy(Caption $caption)
    {
        $this->handler->store($caption);
        return $this->getResuft();
    }
}
