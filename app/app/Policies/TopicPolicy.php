<?php

namespace App\Policies;

use App\Models\Topic;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
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

    public function update(User $currentUser, Topic $topic){
        return $currentUser->id === $topic->user_id;
    }

    public function delete(User $currentUser, Topic $topic){
        return $currentUser->id === $topic->user_id;
    }
}
