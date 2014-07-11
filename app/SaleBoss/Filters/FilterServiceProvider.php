<?php namespace SaleBoss\Filters;

use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider {

    /**
     *  Add Filters to the application container
     *
     * @return void
     */
    public function boot()
    {
        $this->app['router']->filter('auth','SaleBoss\Filters\SimpleAccessFilter@auth');
        $this->app['router']->filter('guest','SaleBoss\Filters\SimpleAccessFilter@guest');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}