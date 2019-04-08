<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function store(UserRequest $request){
        //验证 code 是否正确
        $verification = \Cache::get($request->verification_key);
        if(!$verification){
            return $this->response->error('验证码已失效', 422);
        }

        //通过后
        if(!hash_equals($verification['code'], $request->verification_code)){
            return $this->response->errorUnauthorized('验证码错误');
        }
        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->phone    = $verification['phone'];
        $user->save();

        \Cache::forget($request->verification_key);

        return $this->response->created();
    }
}
