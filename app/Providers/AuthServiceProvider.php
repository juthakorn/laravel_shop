<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        'App\Model\Forum' => 'App\Policies\ForumPolicy',
        'App\Model\Reply' => 'App\Policies\ReplyPolicy',
        'App\Model\Order' => 'App\Policies\OrderPolicy',
        'App\Model\Address' => 'App\Policies\AddressPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
