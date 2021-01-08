<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SerchServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
          'serch',
          'App\Http\Components\Serch'
        );
    }
 
}