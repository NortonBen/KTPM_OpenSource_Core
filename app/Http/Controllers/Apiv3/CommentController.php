<?php

namespace App\Http\Controllers\Apiv3;

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
        if ($request->acceptsJson()) {
            $data = $request->json()->all();
            $this->handler->index($data, $caption);
        }
        return $this->getResuft();
    }

    public function store(Request $request)
    {
        if ($request->acceptsJson()) {
            $data = $request->json()->all();
            $this->handler->store($data);
        }
        return $this->getResuft();
    }

    public function update(Request $request, Comment $comment)
    {
        if ($request->acceptsJson()) {
            $data = $request->json()->all();
            $this->handler->update($data, $comment);
        }
        return $this->getResuft();
    }

    public function destroy(Comment $comment)
    {
        $this->handler->destroy($comment);
        return $this->getResuft();
    }
}
