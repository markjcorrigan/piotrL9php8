<?php

namespace App\Providers;

use App\Models\BlogPost;
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

        //BlogPost::class => 'App\Policies\BlogPostPolicy',
        'App\BlogPost' => 'App\Policies\BlogPostPolicy',
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Comment' => 'App\Policies\CommentPolicy'
    ];



    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('home.secret', function ($user) {
            return $user->is_admin;

        });

//        Gate::define('update-post', function ($user, $post) {
//            return $user->id == $post->user_id;
//        });
//
//        Gate::define('delete-post', function ($user, $post) {
//            return $user->id == $post->user_id;
//        });

//        Gate::define('posts.update', 'App\Policies\BlogPostPolicy@update');  //NB need to change PostController as was update.post and now posts.update
//        Gate::define('posts.delete', 'App\Policies\BlogPostPolicy@delete');
//        Gate::resource('posts' , 'App\Policies\BlogPostPolicy');

//      Gate::before(function ($user, $ability) {
//            if($user->is_admin && in_array($ability, ['update-post', 'delete-posts'])) {  /// 'posts-update'
//            return true;  //can perform all actions prohibited by the Gate actions above.
//        }
//        });


      Gate::before(function ($user, $ability) {
            if($user->is_admin && in_array($ability, ['update', 'delete'])) {
            return true;  //can perform all actions prohibited by the Gate actions above.
        }
        });
    }
}
