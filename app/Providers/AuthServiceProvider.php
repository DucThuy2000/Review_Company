<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user){
           $roles = $user -> roles;
           foreach ($roles as $key => $value){
               $permissions = json_decode($value -> permissions,true);
               foreach ($permissions as $request => $on){
                   Gate::define($request, function () use ($on){
                       return $on;
                   });
               }
           }
        });
    }
}
