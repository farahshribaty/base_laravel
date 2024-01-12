<?php

namespace App\Providers;

use App\Interfaces\AuthInterface;
use App\Interfaces\CartInterface;
use App\Interfaces\CategoryInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\WishListInterface;
use App\Repositories\AuthRepository;
use App\Repositories\CartRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\WishListRepository;
use Illuminate\Support\ServiceProvider;


class RepoProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryInterface::class , CategoryRepository::class);
        $this->app->bind(ProductInterface::class , ProductRepository::class);
        $this->app->bind(WishListInterface::class , WishListRepository::class);
        $this->app->bind(CartInterface::class , CartRepository::class);
        $this->app->bind(AuthInterface::class , AuthRepository::class);


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
