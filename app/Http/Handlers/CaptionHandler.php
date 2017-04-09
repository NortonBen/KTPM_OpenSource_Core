<?php
/**
 * Created by PhpStorm.
 * User: wind
 * Date: 10/04/2017
 * Time: 12:29 SA
 */

namespace App\Http\Handlers;

use App\Action;
use App\Caption;
use DB;
use Illuminate\Support\Facades\Auth;
use Validator;


class CaptionHandler extends Handler
{
    public function index($data = [])
    {
        if (!isset($data['part'])) {
            $data['part'] = 10;
        }
        $this->setData($data);
        $user = DB::table("captions");
        if ($this->has("search")) {
            $user->where("text", "like", '%' . $this->get("search") . '%');
        }

        if ($this->has("order_by")) {
            $order = $this->get("order_by");
            if ($order == 1) { // create
                $user->orderBy("created_at");
            }
            if ($order == 2) { // update_at
                $user->orderBy("updated_at");
            }
        }
        $data = $user->simplePaginate($this->get('part'));
        $this->resuft = ['success' => $data];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($data = array())
    {
        $user = Auth::user();
        $validator = Validator::make($data, [
            "text" => "required",
        ], $this->message);
        if ($validator->fails()) {
            $this->resuft = ['validator' => $validator->errors()];
            return $this->resuft;
        }
        $data['user_id'] = $user->id;
        if (Caption::create($data)) {
            $this->resuft = ['success' => 'true'];
            return $this->resuft;
        }
        $this->resuft = ['error' => 'occur_error'];
        return $this->resuft;
    }


    public function update($data = array(), Caption $caption)
    {
        $user = Auth::user();
        if ($caption->user_id != $user->id) {
            $this->resuft = ['error' => 'not accset'];
            return $this->resuft;
        }
        $validator = Validator::make($data, [
            "text" => "required"

        ], $this->message);
        if ($validator->fails()) {
            $this->resuft = ['validator' => $validator->errors()];
            return $this->resuft;
        }
        if ($caption->update($data)) {
            $this->resuft = ['success' => 'true'];
            return $this->resuft;
        }
        $this->resuft = ['error' => 'occur_error'];
        return $this->resuft;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caption $caption)
    {
        $user = Auth::user();
        if ($caption->user_id != $user->id) {
            $this->resuft = ['error' => 'not accset'];
            return $this->resuft;
        }
        if ($caption->delete()) {
            $this->resuft = ['success' => 'true'];
            return $this->resuft;
        }
        $this->resuft = ['error' => 'occur_error'];
        return $this->resuft;
    }

    public function show(Caption $caption)
    {
        $action = DB::table('actions')
            ->where('caption_id', '=', $caption->id)->orderBy('type_action')
            ->select('type_action', DB::raw('COUNT(id) as total'))->get();
        $comment = DB::table('comments')
            ->where('caption_id', '=', $caption->id)
            ->select(DB::raw('COUNT(id) as total'))->first();
        $this->resuft = ['success' => [
            'caption' => $caption,
            'action' => $action,
            'comment' => $comment
        ]];
        return $this->resuft;
    }


}