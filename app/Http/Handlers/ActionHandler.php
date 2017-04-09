<?php
/**
 * Created by PhpStorm.
 * User: wind
 * Date: 10/04/2017
 * Time: 12:48 SA
 */

namespace App\Http\Handlers;


use App\Action;
use App\Caption;
use Validator;
use App\TypeAction;
use Illuminate\Support\Facades\Auth;

class ActionHandler extends  Handler
{
    public function index(Caption $caption,$data = array()){
        if(!isset($data['part'])){
            $data['part'] = 10;
        }
        $this->setData($data);
        $rs = DB::table("actions");
        $rs->where("caption_id","=",$caption->id);
        if($this->has("type")){
            $rs->where("type_action","=",$this->get("type"));
        }
        $data  = $rs->simplePaginate($this->get('part'));
        $this->resuft = ['success' => $data];
    }

    public function store(Caption $caption,$data = array()){
        $user = Auth::user();
        $this->setData($data);
        $rs = Action::where('user_id','=',$user->id)->where('caption_id','=',$caption->id)->first();
        $validator = Validator::make($data,[
            "type_action"=>"required"
        ],$this->message);

        if ($validator->fails()) {
            $this->resuft =  [ 'validator' => $validator->errors()];
            return $this->resuft;
        }

        if($rs == null){
            $data = [
                'user_id' => $user->id,
                'caption_id' => $caption->id,
                'type_action' => $this->get('type_action'),
            ];
            if(Action::create($data))
            {
                $this->resuft =  [ 'success' => 'true'];
                return $this->resuft;
            }
            $this->resuft =  [ 'error' => 'occur_error'];
            return $this->resuft;
        }
        $rs->type_action = $this->get('type_action');
        if($rs->save())
        {
            $this->resuft =  [ 'success' => 'true'];
            return $this->resuft;
        }
        $this->resuft =  [ 'error' => 'occur_error'];
        return $this->resuft;

    }

    public  function destroy(Caption $caption){
        $user = Auth::user();
        $rs = Action::where('user_id','=',$user->id)->where('caption_id','=',$caption->id)->first();
        if($rs != null){
            $rs->delete();
            $this->resuft =  [ 'success' => 'true'];
            return $this->resuft;
        }
    }
}