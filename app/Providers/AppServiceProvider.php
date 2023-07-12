<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFive();
        
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway([
                'environment' => 'sandbox',
                'merchantId' => 'tfrvnyfh3xsz95xv',
                'publicKey'=> 'ny5hbf8ggmgbqcsh',
                'privateKey'=>'cbf63464e790adef49943d1efa26f178'
            ]);
        });
    }
}
