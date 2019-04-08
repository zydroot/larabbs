<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract {

    public function transform(User $user){
        return [
            'id'     => $user->id,
            'name'   => $user->name,
            'phone'  => $user->phone,
            'created_at' => $user->created_at,
        ];
    }
}
