<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Overtrue\EasySms\EasySms;

class VerificationCodesController extends BaseController
{
    //
    public function store(VerificationCodeRequest $request, EasySms $easysms){

        $phone = $request->mobile;
        //生成验证码，编辑短信，给手机号发送验证码；
        //验证码缓存
        if(!app()->environment('production')){
            $code = 1234;
        }else{
            $code = str_pad( random_int(1,9999), 4, 0, STR_PAD_RIGHT);
            try{
                $easysms->send($phone, [
                    'content' => "【xxx社区】您的验证码是$code,请不要向任何人透露此验证码",
                ]);
            }catch (Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception){
                $errmessage = $exception->getException('yunpian')->getMessage();
                return $this->response->errorInternal($errmessage?:'短信发送异常');
            }
        }

        $key = 'varificationCode_'. str_random(15);
        $expireAt = now()->addMinutes(10);

        //缓存验证码，10分钟过期
        \Cache::put($key, ['phone'=>$phone, 'code'=>$code], $expireAt);

        Log::error("存入key 的值：");
        Log::error($key);

        return $this->response->array([
            'key' => $key,
            'expired_at' => $expireAt->toDateTimeString(),
        ])->setStatusCode(201);
    }

}
