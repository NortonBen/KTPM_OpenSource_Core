<?php

namespace App\Http\Controllers\Apiv3;

use App\Http\Handlers\UserHandler;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->handler = new UserHandler();
        $this->handler->setMessage($this->message());
    }

    public function index(Request $request)
    {
        $data = $request->only(['order_by','part','search']);
        $this->handler->index($data);

        if($this->handler->isValidator()){
            return $this->api_response_error([ 'validator' => $this->handler->getValidator()]);
        }

        if($this->handler->isSuccess()){
            return $this->api_response($this->handler->getSuccess());
        }

        if($this->handler->isError()){
            return $this->api_response_error($this->handler->getSuccess());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->acceptsJson()){
            $data = $request->json()->all();
            $this->handler->store($data);
        }
        return $this->getResuft();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->api_response($user);
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
        if($request->acceptsJson()){
            $data = $request->json()->all();
            $this->handler->password($data,$user);
        }
        return $this->getResuft();
    }

    public function update(Request $request, User $user)
    {
        if($request->acceptsJson()){
            $data = $request->json()->all();
            $this->handler->update($data,$user);
        }
        return $this->getResuft();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->handler->destroy($user);
        return $this->getResuft();
    }
}
