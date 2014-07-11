<?php namespace SaleBoss\Services\Menu;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider {

    public $defered = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'menu_builder',
            function($app){
                return App::make('SaleBoss\Services\Menu\Manager');
            }
        );
    }
}