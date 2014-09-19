<?php namespace SaleBoss\Services\Presenters;


use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class PresenterServiceProvider extends ServiceProvider {

	protected $defered = true;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('common_presenter',function($app)
		{
			return App::make('SaleBoss\Services\Presenters\CommonDataPresenter');
		});
	}
}