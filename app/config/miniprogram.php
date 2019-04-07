<?php

return [
    'app_id'  => 'wx2438c94dceeeff6e',
    'secret' => '236ceb1bdcf3614e001c0f7e99698229',
    //'code2Session' => "https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",

    'response_type' => 'array',

    'log' => [
        'level' => 'debug',
        'file' => __DIR__.'/wechat.log',
    ],
];
