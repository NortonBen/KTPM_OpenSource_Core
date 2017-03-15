<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = DB::table("users");
        if($request->has("search")){
            $user->where("first_name","like",'%'.$request->get("search").'%');
            $user->where("last_name","like",'%'.$request->get("search").'%');
            $user->where("phone","like",'%'.$request->get("search").'%');
            $user->where("address","like",'%'.$request->get("search").'%');
            $user->where("description","like",'%'.$request->get("search").'%');
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
        $data  = $user->select( "id", "first_name", "last_name", "email", "sex", "phone","birthday", "description","address","company","relationships","phone_parent")->get();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
