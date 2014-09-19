<?php namespace Controllers;

use Miladr\Jalali\jDate;
use Miladr\Jalali\jDateTime;
use SaleBoss\Models\User;
use SaleBoss\Services\Menu\Facades\MenuBuilder;

class HomeController extends BaseController {

    public function __construct(
        MenuBuilder $builder
    ){
        $this->builder = $builder;
    }

	public function getIndex()
	{
		return $this->redirectTo('dash');
	}

}
