<?php namespace SaleBoss\Services\Presenters\Facades;

use Illuminate\Support\Facades\Facade;

class CommonPresenter extends Facade {

	/**
	 * Get IoC binding name
	 *
	 * @return string
	 */
	public static function getFacadeAccessor()
	{
		return 'common_presenter';
	}
} 