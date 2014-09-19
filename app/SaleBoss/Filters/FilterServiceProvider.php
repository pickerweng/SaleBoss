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
	    $this->app['router']->filter('hasPermission','SaleBoss\Filters\PermissionFilter@hasPermission');
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
