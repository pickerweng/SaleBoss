<?php namespace Controllers;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use SaleBoss\Services\Menu\Facades\MenuBuilder;
use SaleBoss\Services\User\UserQueue;

class HomeController extends BaseController {

    public function __construct(
        MenuBuilder $builder,
		UserQueue $uQueue
    ){
        $this->builder = $builder;
	    $this->uQueue = $uQueue;
    }


	/**
	 *
	 *
	 * @return mixed
	 */
	public function getIndex()
	{
        $this->uQueue->setUser(Sentry::getUser());
		dd($this->uQueue->summary()->lists('id'));

	}

}
