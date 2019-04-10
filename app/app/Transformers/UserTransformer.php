<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract {

    public function transform(User $user){
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'introduction' => $user->introduction,
            'bound_phone' => $user->phone ? substr_replace($user->phone,'****', 3, 4) : false,
            'bound_wechat' => ($user->weixin_unionid || $user->weixin_openid) ? true : false,
            'last_actived_at' => $user->last_actived_at ? $user->last_actived_at->toDateTimeString() : null,
            'created_at' => $user->created_at ? $user->created_at->toDateTimeString() : null,
            'updated_at' => $user->updated_at ? $user->updated_at->toDateTimeString() : null,
        ];
    }
}
