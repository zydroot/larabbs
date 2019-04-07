<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',[
    'namespace' => 'App\Http\Controllers\Api',
    'middleware'=> 'serializer:array'
], function($api) {
    $api->get('version', function() {
        return response('this is version v1');
    });
    // 小程序登陆，传入登录凭证 code
    $api->post('login', 'IndexController@Login');

    $api->group([
        'middleware'=>'api.throttle',
        'limit'  => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires')
    ], function($api){
        // 请求发送验证码
        $api->post('varificationCodes', 'VerificationCodesController@store')
            ->name('api.verificationCodes.store');

        //非登录即可获取
        $api->get('secondHouses', 'SecondHousesController@index')
            ->name('api.secondHouse.index');
        // 获取
        $api->get('secondHouses/{secondHouse}', 'SecondHousesController@show')
            ->name('api.secondHouse.show');
    });

    // 提交code，验证openid
    $api->post('weapp/authorizations', 'AuthorizationsController@weappStore')
        ->name('api.weapp.authorizations.store');

    // 刷新token
    $api->put('authorizations/current', 'AuthorizationsController@update')
        ->name('api.authorizations.update');
    // 删除token
    $api->delete('authorizations/current', 'AuthorizationsController@destroy')
        ->name('api.authorizations.destroy');

    $api->get('test', 'IndexController@test');

    $api->group(['middleware' => 'api.auth'], function($api){
        // 获取当前登陆用户信息
        $api->get('user', 'UserController@me')
            ->name('api.user.show');
        //当前登录用户权限
        $api->get('user/permissions', "PermissionsController@index")
            ->name("api.user/permissions.index");


    });


});

$api->version('v2', function($api) {
    $api->get('version', function() {
        return response('this is version v2');
    });
});
