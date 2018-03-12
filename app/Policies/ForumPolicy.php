<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Forum;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumPolicy
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
     * @param  \App\Model\Forum  $post
     * @return bool
     */
    public function modify(User $user, Forum $forum)
    {
        return $user->id === $forum->user_id;
    }
}
