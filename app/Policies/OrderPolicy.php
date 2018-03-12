<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
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
     * @param  \App\Model\Order  $order
     * @return bool
     */
    public function pagedetail(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }
}
