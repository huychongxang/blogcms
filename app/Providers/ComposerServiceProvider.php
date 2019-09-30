<?php

namespace App\Providers;

use App\Category;
use App\Post;
use App\Views\Composers\SidebarComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('includes.sidebar', SidebarComposer::class);
    }
}
