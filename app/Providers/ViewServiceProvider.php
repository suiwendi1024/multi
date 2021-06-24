<?php

namespace App\Providers;

use App\Http\View\Composers\CategoriesComposer;
use App\Http\View\Composers\RankingPostsComposer;
use App\Http\View\Composers\SideProductsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(['posts._category-nav', 'posts.create-edit'], CategoriesComposer::class);
        View::composer('posts.index', RankingPostsComposer::class);
        View::composer('products.show', SideProductsComposer::class);
    }
}
