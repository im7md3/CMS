<?php

namespace App\Providers;

use App\Permission;
use App\Post;
use App\User;
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

        Gate::define('edit-post',function(User $user,Post $post){
            return $user->id===$post->user_id;
        });

        Gate::define('delete-post',function($user,$post){
            return $user->hasAllow('edit-post') && ($user->id==$post->user_id);
        }); 

        /* Permission::get(['name'])->map(function($permission){
            Gate::define($permission->name,function($user) use ($permission){
                return $user->hasAllow($permission->name) && ($user);
            });
        }); */
    }
}
