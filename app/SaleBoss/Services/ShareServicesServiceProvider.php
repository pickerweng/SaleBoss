<?php namespace SaleBoss\Services;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ShareServicesServiceProvider extends ServiceProvider {

    public function boot(){
        $dashboard= $this->app->make('SaleBoss\Services\User\Dashboard');
        if( Sentry::getUser() ) { $this->setViews($dashboard); }
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    public function setViews($dash){
        $dash->setUser(Sentry::getUser());
        $data = $dash->getHisDash();
        foreach($data as $key => $value){
            View::share($key,$value);
        }
    }
}