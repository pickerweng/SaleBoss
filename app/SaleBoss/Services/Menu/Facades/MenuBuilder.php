<?php namespace SaleBoss\Services\Menu\Facades;


use Illuminate\Support\Facades\Facade;

class MenuBuilder extends Facade {
	/**
	 * Menu Builder IoC
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor(){return "menu_builder";}
}