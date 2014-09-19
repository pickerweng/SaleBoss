<?php namespace SaleBoss\Services\Leads\Presenter\Facades;

use Illuminate\Support\Facades\Facade;

class ThrottleL extends Facade {
    /**
     * Menu Builder IoC
     *
     * @return string
     */
    protected static function getFacadeAccessor(){return "lead_throttle";}
}