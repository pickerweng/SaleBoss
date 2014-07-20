<?php namespace Controllers;

use SaleBoss\Services\Menu\Facades\MenuBuilder;

class HomeController extends BaseController {

    public function __construct(
        MenuBuilder $builder
    ){
        $this->builder = $builder;
    }


	/**
	 * @return mixed
	 */
	public function getIndex()
	{
        dd(\MenuBuilder::fetch('sidebar'));
	}

}
