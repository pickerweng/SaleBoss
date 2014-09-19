<?php namespace SaleBoss\Services\Leads;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class LeadServiceProvider extends ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register ()
    {
        $this->app->bind(
            'SaleBoss\Services\Leads\Creator\CreatorInterface',
            'SaleBoss\Services\Leads\Creator\Creator'
        );

        $this->app->bind(
            'SaleBoss\Services\Leads\Importer\FactoryInterface',
            'SaleBoss\Services\Leads\Importer\ImporterFactory'
        );

        $this->app->bind(
            'SaleBoss\Services\Leads\Presenter\DelegateManInterface',
            'SaleBoss\Services\Leads\Presenter\DelegateMan'
        );

        $this->app->bindShared('lead_throttle',function($app){
            $throttle = App::make('SaleBoss\Services\Leads\Presenter\Throttle');
            $throttle->setUser(Sentry::getUser());
            return $throttle;
        });
    }
}