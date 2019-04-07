<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/17
 * Time: 14:59
 */

namespace App\Http\Controllers\Api;

use App\Http\Requests\AuthorizationRequest;
use App\Models\FangBusinessSecond;
use App\Models\Winxin;
use App\User;
use EasyWeChat\Factory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Support\Facades\Cache;

class IndexController extends BaseController
{
    private $expire_time = 7200;

    function Login(AuthorizationRequest $request){
        //$data = $request->all();
        $code = $request->input('code');

        $mini_config = config('miniprogram');

        $miniProgram = Factory::miniProgram($mini_config);

        $data = $miniProgram->auth->session($code);

        if(isset($data['errcode'])){
            return $this->response->errorUnauthorized('code 不正确');
        }




        /*$client = new Client([
            'base_uri' => config('app.url'),
            'timeout'  => '2'
        ]);

        $code2Session_url = sprintf(config('miniprogram.code2Session'), config('miniprogram.appid'), config('miniprogram.secret'), $code);
        try{
            $response = $client->request('GET', $code2Session_url);
        }catch (RequestException $e){
            return $e->getResponse();
        }

        $re_data = json_decode($response->getBody(),true);
        if(!key_exists('errorcode', $re_data)){
            return $this->response->array($re_data);
        }
        $winxin = Winxin::where('openid', $re_data['openid'])->first();
        if(!empty($winxin)){
            $winxin_user = Winxin::create($re_data);
            // 返回登陆状态
        }else{
            // 提取并返回登陆状态
        }*/

        return $this->response->array($data);
    }

    function test(){

        $token = "fadfwegagAFG";
        $this->respondWithToken($token);

    }


}
