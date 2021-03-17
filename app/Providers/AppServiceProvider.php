<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['partials.sidebar', 'lists.categories'], 'App\Http\ViewComposer\CategoryComposer');
        view()->composer('partials.sidebar', 'App\Http\ViewComposer\CommentComposer');
        view()->composer('lists.roles', 'App\Http\ViewComposer\RoleComposer');
        view()->composer('partials.navbar', 'App\Http\ViewComposer\PageComposer');

        \Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });
    }
}
