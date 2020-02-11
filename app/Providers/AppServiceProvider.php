<?php

namespace ByeTweets\Providers;

use Illuminate\Support\ServiceProvider;
use ByeTweets\Helpers\MyTwitterConnection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MyTwitterConnection::class, function(){
            return new MyTwitterConnection();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
