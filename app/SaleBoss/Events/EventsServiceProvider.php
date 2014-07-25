<?php namespace SaleBoss\Events;

use Illuminate\Support\ServiceProvider;

class EventsServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    public function boot()
    {
        $this->app['events']->listen(
          'customer.created',
          'SaleBoss\Events\Customer@whenCustomerHasBeenCreated'
        );
    }
}