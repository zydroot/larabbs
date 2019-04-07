<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AuthorizationRequest;
use App\User;
use EasyWeChat\Factory;
use Auth;
use Illuminate\Support\Facades\Log;

class AuthorizationsController extends BaseController
{
    //
    public function weappStore(AuthorizationRequest $request){
        $code = $request->code;

        //根据code获取openid和session_key
        $miniProgram = Factory::miniProgram(config('miniprogram'));
        $data = $miniProgram->auth->session($code);

        if(isset($data['errcode'])){
            return $this->response->errorUnauthorized('code不正确');
        }

        $user = User::where('weapp_openid', $data['openid'])->first();

        $attributes['weixin_session_key'] = $data['session_key'];

        //没有找到用户需要提交手机号绑定
        if(!$user){
            if(!$request->mobile){
                return $this->response->errorForbidden('手机号不存在');
            }

            if(!$request->verification_code){
                return $this->response->errorForbidden('验证码没有提交');
            }

            if(!$request->verification_key){
                return $this->response->errorForbidden('key 没有提交');
            }

            $verifyData = \Cache::get($request->verification_key);


            if(!$verifyData){
                return $this->response->error('验证码已失效', 422);
            }
            if(!hash_equals($request->verification_code, (string)$verifyData['code'])){
                return $this->response->errorUnauthorized('验证码错误');
            }
            $where = [
                'mobile' => $request->mobile,
                'status' => 1
            ];
            $user = User::where($where)->firstOrFail();
            Auth::login($user);
            $attributes['weapp_openid'] = $data['openid'];
        }

        // 更新用户数据
        $user->update($attributes);

        // 为对应用户创建 JWT
        $token = Auth::guard('api')->fromUser($user);

        Log::error($token);
        // code mobile mobile_key session_key
        return $this->respondWithToken($token)->setStatusCode(201);
    }

    // 更新令牌
    public function update(){
        $token = Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }

    // 销毁令牌
    public function destroy(){
        Auth::guard('api')->logout();
        return $this->response->noContent();
    }

    protected function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }

}
