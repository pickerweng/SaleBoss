<?php

namespace Controllers\Opilo;

use Controllers\BaseController;
use SaleBoss\Repositories\EavRepositoryManagerInterface;
use SaleBoss\Services\EavSmartAss\EavManagerInterface;

class OrderController extends BaseController {

	public function __construct(
		EavRepositoryManagerInterface $eavRepo
	)
	{
		$this->eavRepo = $eavRepo;
	}

	protected $layout = 'panel.layouts.master';

	public function getIndex(){
		return \View::make('panel.pages.opilo-orders.show',['orders' => $this->eavRepo->getEntity(1)]);
	}

	public function getShow($id){

	}

	public function getCreate(){
		$this->view('panel.pages.opilo-orders.create');
	}
} 