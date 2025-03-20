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
        $this->app->bind(ItemRepository::class, function ($app) {
            return new ItemRepository();
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
