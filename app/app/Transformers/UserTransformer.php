<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract {

    public function transform(User $user){
        return [
            'id'         => $user->id,
            'username'   => $user->username,
            'reg_time'   => date('Y-m-d',$user->reg_time),
            'login_time' => date('Y-m-d',$user->login_time),
            'reg_ip'     => $user->reg_ip,
            'login_ip'   => $user->login_ip,
            'login_num'  => $user->login_num,
            'model'      => $user->model,
            'bound_mobile' => $user->mobile? true : false,
            'bound_wechat' => ($user->wexin_unionid || $user->weapp_openid) ? true : false,
            'status'     => $user->status,
        ];
    }
}
