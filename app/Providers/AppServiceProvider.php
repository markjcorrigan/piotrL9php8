<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Http\ViewComposers\ActivityComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.badge', 'badge');
        Blade::component('components.updated', 'updated');
        Blade::component('components.card', 'card');
        Blade::component('components.tags', 'tags');
        Blade::component('components.errors', 'errors');

//        view()->composer('posts.index', ActivityComposer::class);
//        view()->composer('posts.show', ActivityComposer::class);
//
// or to make the ActivityComposer available in every view you have you will do this
//     view()->composer('*' , ActivityComposer::class);

        view()->composer(['posts.index', 'posts.show'], ActivityComposer::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
