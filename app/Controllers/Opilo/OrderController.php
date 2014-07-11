<?php

namespace Controllers\Opilo;

use Controllers\BaseController;
use SaleBoss\Services\EavSmartAss\EavManagerInterface;
use SaleBoss\Services\EavSmartAss\Form\FormOptionProvider;

class OrderController extends BaseController {

	protected $layout = 'admin.layouts.default';

	public function __construct(
		EavManagerInterface $eavManager,
		FormOptionProvider $option
	)
	{
		$this->eavManager = $eavManager;
		$this->option = $option;
	}

	public function getCreate()
	{
		$attributes = $this->eavManager->setType('opilo_orders')->getAttributes();
		$options = $this->option->setAttributes($attributes)->getOptions();
		$this->view('panel.pages.opilo-orders.create',compact(
			'attributes',
			'options'
		));
	}
}