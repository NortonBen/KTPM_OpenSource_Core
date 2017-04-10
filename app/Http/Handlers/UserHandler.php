<?php

namespace App\Http\Handlers;

use App\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserHandler extends Handler
{
    public function index($data = [])
    {
        if(!isset($data['part'])){
            $data['part'] = 30;
        }
        $this->setData($data);
        $user = DB::table("users");
        if($this->has("search")){
            $user->where("first_name","like",'%'.$this->get("search").'%');
            $user->orwhere("last_name","like",'%'.$this->get("search").'%');
            $user->orwhere("phone","like",'%'.$this->get("search").'%');
            $user->orwhere("address","like",'%'.$this->get("search").'%');
            $user->orwhere("description","like",'%'.$this->get("search").'%');
        }

        if($this->has("order_by")){
            $order = $this->get("order_by");
            if($order == 1){ // name
                $user->orderBy("first_name");
            }
            if($order == 2){ // birthday
                $user->orderBy("birthday");
            }
        }
        $data  = $user->select( "id", "first_name", "last_name", "email", "sex", "phone","birthday", "description","address","company","relationships","phone_parent")->simplePaginate($this->get('part'));
        $this->resuft = ['success' => $data];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($data = array())
    {
        $this->setData($data);
        $validator = Validator::make($data,[
            "first_name"=>"required",
            "last_name"=>"required",
            'email' => 'required|email|max:255|unique:users',
            "password" => "required | between:6,20",
            "repassword" => "required | same:password",
            "sex"=> "required",
            "phone"=> "required | between:11,20",
            "birthday"=> "required",
            "description"=>"required",
            "address"=>"required",
            "company"=>"required",
            "relationships"=>"required",
            "phone_parent"=>"required | between:11,20 "

        ],$this->message);
        if ($validator->fails()) {
            $this->resuft =  [ 'validator' => $validator->errors()];
            return $this->resuft;
        }
        $data = $this->only(['first_name','last_name','email','password','sex','phone','birthday','description','address','company','relationships','phone_parent']);
        $data['password'] = Hash::make($data['password']);

        if(User::create($data))
        {
            $this->resuft =  [ 'success' => 'true'];
            return $this->resuft;
        }
        $this->resuft =  [ 'error' => 'occur_error'];
        return $this->resuft;
    }


    public function password($data =  array(),User $user)
    {
        $this->setData($data);
        $validator = Validator::make($data,[
            "oldpassword" => "required",
            "password" => "required | between:6,20",
            "repassword" => "required | same:password",
        ],$this->message);
        if($validator->fails())
        {
            $this->resuft =  [ 'validator' => $validator->errors()];
            return $this->resuft;
        }
        if(!$user->checkPassword($this->get("oldpassword"))){
            $this->resuft =  [ 'error' => 'Mật Khẩu Sai!'];
            return $this->resuft;
        }
        $data = [];
        $data['password'] = Hash::make($this->get("password"));
        if( $user->update($data))
        {
            $this->resuft =  [ 'success' => 'true'];
            return $this->resuft;
        }
        $this->resuft =  [ 'error' => 'occur_error'];
        return $this->resuft;
    }

    public function update($data  = array(), User $user)
    {
        $this->setData($data);
        $validator = Validator::make($data,[
            "first_name"=>"required",
            "last_name"=>"required",
            "sex"=> "required",
            "phone"=> "required | between:11,20",
            "birthday"=> "required",
            "address"=>"required",
            "company"=>"required",
            "relationships"=>"required",
            "phone_parent"=>"required | between:11,20 "

        ],$this->message);
        if($validator->fails())
        {
            $this->resuft =  [ 'validator' => $validator->errors()];
            return $this->resuft;
        }
        $data = $this->only(['first_name','last_name', 'sex', 'phone','birthday','address','relationships','phone_parent']);
        if($user->update($data))
        {
            $this->resuft =  [ 'success' => 'true'];
            return $this->resuft;
        }
        $this->resuft =  [ 'error' => 'occur_error'];
        return $this->resuft;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete())
        {
            $this->resuft =  [ 'success' => 'true'];
            return $this->resuft;
        }
        $this->resuft =  [ 'error' => 'occur_error'];
        return $this->resuft;
    }
}
