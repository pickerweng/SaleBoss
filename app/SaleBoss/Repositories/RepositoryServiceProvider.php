<?php

namespace SaleBoss\Repositories;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'SaleBoss\Repositories\EavRepositoryManagerInterface',
			'SaleBoss\Repositories\EavRepositoryManager'
		);

		$this->app->bind(
			'SaleBoss\Repositories\EntityTypeRepositoryInterface',
			'SaleBoss\Repositories\Eloquent\EntityTypeRepository'
		);

		$this->app->bind(
			'SaleBoss\Repositories\EntityRepositoryInterface',
			'SaleBoss\Repositories\Eloquent\EntityRepository'
		);

		$this->app->bind(
			'SaleBoss\Repositories\AttributeRepositoryInterface',
			'SaleBoss\Repositories\Eloquent\AttributeRepository'
		);

		$this->app->bind(
			'SaleBoss\Repositories\ValueRepositoryInterface',
			'SaleBoss\Repositories\Eloquent\ValueRepository'
		);
	}
}