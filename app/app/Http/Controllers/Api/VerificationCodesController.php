<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;

class VerificationCodesController extends Controller
{
    //
    public function store(VerificationCodeRequest $request, EasySms $easySms){

        $phone = $request->mobile;


        if(!app()->environment('production')){
            $code = '1234';
        }else{
            //生成随机数
            $code = str_pad(random_int(1,9999), 4, 0, STR_PAD_LEFT);
            //发送短信
            try{
                $result = $easySms->send($phone, [
                    'content'=>"您的验证码是{$code}。如非本人操作，请忽略本短信"
                ]);
            } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception){
                $message = $exception->getException('errorlog')->getMessage();
                return $this->response->errorInternal($message ?: "短信发送异常");
            }
        }

        //code存入缓存
        $key = "verificationCode_". str_random(15);
        $expireAt = now()->addMinutes(10);

        //缓存验证码，10分钟过期
        \Cache::put($key, ['phone'=>$phone, 'code'=>$code], $expireAt);

        return $this->response->array([
            'key' => $key,
            'expire_at' => $expireAt->toDateTimeString()
        ])->setStatusCode(300);

    }
}
