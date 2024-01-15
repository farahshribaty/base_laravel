<?php

namespace App\Providers;

use App\Interfaces\AuthInterface;
use App\Interfaces\CartInterface;
use App\Interfaces\CategoryInterface;
use App\Interfaces\OrderInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\WishListInterface;
use App\Repositories\AuthRepository;
use App\Repositories\CartRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
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
        $this->app->bind(OrderInterface::class , OrderRepository::class);
        $this->app->bind(UserInterface::class , UserRepository::class);
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
