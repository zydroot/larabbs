<?php

namespace App\Policies;

use App\Models\Reply;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, Reply $reply){
        return $user->isAuthorOf($reply) || $user->isAuthorOf($reply->topic);
    }
}
