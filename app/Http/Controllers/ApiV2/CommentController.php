<?php

namespace App\Http\Controllers\ApiV2;

use App\Caption;
use App\Comment;
use App\Http\Handlers\CommentHandler;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->handler = new CommentHandler();
        $this->handler->setMessage($this->message());
    }

    public function index(Caption $caption, Request $request)
    {
        $data = $request->only(['part']);
        $this->handler->index($data, $caption);
        return $this->getResuft();
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $this->handler->store($data);
        return $this->getResuft();
    }

    public function update(Request $request, Comment $comment)
    {

        $data = $request->all();
        $this->handler->update($data, $comment);
        return $this->getResuft();
    }

    public function destroy(Comment $comment)
    {
        $this->handler->destroy($comment);
        return $this->getResuft();
    }
}
