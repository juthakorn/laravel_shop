<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Reply;
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
    /**
     * Determine if the given post can be modify by the user.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Reply  $reply
     * @return bool
     */
    public function modify(User $user, Reply $reply)
    {
        return $user->id === $reply->user_id;
    }
}
