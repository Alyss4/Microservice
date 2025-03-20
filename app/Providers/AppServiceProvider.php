<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ItemRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register()
    {
        $this->app->singleton(ItemRepository::class, function ($app) {
            return new ItemRepository($app->make(\App\Models\Item::class));
        });
    }



    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
