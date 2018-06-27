<?php

namespace Mws\Support;

use Mws\Collection;
use Mws\Mws;
use Illuminate\Support\ServiceProvider;

class MwsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Mws\Mws', function ($app) {
            $collection = new Collection();
            return new Mws($collection);
        });
    }
}
