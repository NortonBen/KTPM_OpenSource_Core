<?php
/**
 * Created by PhpStorm.
 * User: wind
 * Date: 10/04/2017
 * Time: 12:30 SA
 */

namespace App\Http\Handlers;


use App\Caption;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class CommentHandler extends Handler
{
    public function index($data = array(), Caption $caption)
    {
        if (!isset($data['part'])) {
            $data['part'] = 10;
        }
        $this->setData($data);
        $data = DB::table("comments");
        $data->where("id", "=", $caption->id);
        $data->orderBy("created_at");
        $data = $data->simplePaginate($this->get('part'));
        $this->resuft = ['success' => $data];
    }

    public function store($data = array())
    {
        $validator = Validator::make($data, [
            "text" => "required",
            "user_id" => "required",
            "caption_id" => "required",
        ], $this->message);
        if ($validator->fails()) {
            $this->resuft = ['validator' => $validator->errors()];
            return $this->resuft;
        }

        if (Comment::create($data)) {
            $this->resuft = ['success' => 'true'];
            return $this->resuft;
        }
        $this->resuft = ['error' => 'occur_error'];
        return $this->resuft;
    }

    public function update($data = array(), Comment $comment)
    {
        $user = Auth::user();
        if ($comment->user_id != $user->id) {
            $this->resuft = ['error' => 'not accset'];
            return $this->resuft;
        }
        $validator = Validator::make($data, [
            "text" => "required",
        ], $this->message);
        if ($validator->fails()) {
            $this->resuft = ['validator' => $validator->errors()];
            return $this->resuft;
        }

        if ($comment->update($data)) {
            $this->resuft = ['success' => 'true'];
            return $this->resuft;
        }
        $this->resuft = ['error' => 'occur_error'];
        return $this->resuft;
    }

    public function destroy(Comment $comment)
    {
        $user = Auth::user();
        if ($comment->user_id != $user->id) {
            $this->resuft = ['error' => 'not accset'];
            return $this->resuft;
        }
        if ($comment->delete()) {
            $this->resuft = ['success' => 'true'];
            return $this->resuft;
        }
        $this->resuft = ['error' => 'occur_error'];
        return $this->resuft;
    }
}