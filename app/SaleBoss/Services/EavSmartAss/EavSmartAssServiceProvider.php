<?php

namespace SaleBoss\Services\EavSmartAss;


use Illuminate\Support\ServiceProvider;

class EavSmartAssServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'SaleBoss\Services\EavSmartAss\EavManagerInterface',
			'SaleBoss\Services\EavSmartAss\EavManager'
		);
	}
}