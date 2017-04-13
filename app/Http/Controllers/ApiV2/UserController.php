<?php

namespace App\Http\Controllers\ApiV2;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request,$part = 30)
    {
        $user = DB::table("users");
        if($request->has("search")){
            $user->where("first_name","like",'%'.$request->get("search").'%');
            $user->orwhere("last_name","like",'%'.$request->get("search").'%');
            $user->orwhere("phone","like",'%'.$request->get("search").'%');
            $user->orwhere("address","like",'%'.$request->get("search").'%');
            $user->orwhere("description","like",'%'.$request->get("search").'%');
        }

        if($request->has("order_by")){
            $order = $request->get("order_by");
            if($order == 1){ // name
                $user->orderBy("first_name");
            }
            if($order == 2){ // birthday
                $user->orderBy("birthday");
            }
        }
        $data  = $user->select( "id", "first_name", "last_name", "email", "sex", "phone","birthday", "description","address","company","relationships","phone_parent")->simplePaginate($part);
        //$data = User::all();
        return $this->api_response([
            'users' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "first_name"=>"required",
            "last_name"=>"required",
            "email"=>"required | email",
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

        ],$this->message());
        if ($validator->fails()) {
            return $this->api_response_error([ 'validator' => $validator->errors()]);
        }
        //$data = $request->all();
        $data = $request->only(['first_name','last_name','email','password','sex','phone','birthday','description','address','company','relationships','phone_parent']);
        $data['password'] = Hash::make($data['password']);

        if ($validator->fails()) {
            return $this->api_response_error([ 'validator' => $validator->errors()]);
        }
        if(User::create($data))
        {
            return $this->api_response();
        }
        return $this->api_response_error(['occur_error']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->api_response([
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function password(Request $request,User $user)
    {
        $validator = Validator::make($request->all(),[
            "oldpassword" => "required",
            "password" => "required | between:6,20",
            "repassword" => "required | same:password",
        ],$this->message());
        if($validator->fails())
        {
            return $this->api_response_error([ 'validator' => $validator->errors()]);
        }
        if(!$user->checkPassword($request->get("oldpassword"))){
            return $this->api_response_error(['Mật Khẩu Sai!']);
        }
        $data = [];
        $data['password'] = Hash::make($request->get("password"));
        if( $user->update($data))
        {
            return $this->api_response();
        }
        return $this->api_response_error(['occur_error']);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(),[
            "first_name"=>"required",
            "last_name"=>"required",
            "sex"=> "required",
            "phone"=> "required | between:11,20",
            "birthday"=> "required",
            "address"=>"required",
            "company"=>"required",
            "relationships"=>"required",
            "phone_parent"=>"required | between:11,20 "

        ],$this->message());
        if($validator->fails())
        {
            return $this->api_response_error([ 'validator' => $validator->errors()]);
        }
        $data = $request->only(['first_name','last_name', 'sex', 'phone','birthday','address','relationships','phone_parent']);
        if($user->update($data))
        {
            return $this->api_response();
        }
        return $this->api_response_error(['occur_error']);
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
            return $this->api_response();
        }
        return $this->api_response_error(['occur_error']);
    }

    public function auth(){
         return $this->api_response( Auth::user());
    }
}
