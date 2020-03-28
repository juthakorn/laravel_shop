<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Address;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
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
     * @param  \App\Model\Address  $post
     * @return bool
     */
    public function modify(User $user, Address $address)
    {
        return $user->id === $address->user_id;
    }
}
