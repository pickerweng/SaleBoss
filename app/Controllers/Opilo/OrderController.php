<?php

namespace Controllers\Opilo;

use Controllers\BaseController;
use SaleBoss\OpiloOrders\OrderCreator;
use SaleBoss\Services\EavSmartAss\EavManagerInterface;
use SaleBoss\Services\EavSmartAss\Form\FormOptionProvider;

class OrderController extends BaseController {

	protected $eavManager;
	protected $option;
	protected $orderCreator;

	/**
	 * @param EavManagerInterface $eavManager
	 * @param FormOptionProvider $option
	 * @param OrderCreator $orderCreator
	 */
	public function __construct(
		EavManagerInterface $eavManager,
		FormOptionProvider $option,
		OrderCreator $orderCreator
	)
	{
		$this->eavManager = $eavManager;
		$this->option = $option;
		$this->orderCreator = $orderCreator;
	}

	/**
	 * Store an order in DB
	 *
	 * @return Redirect
	 */
	public function store()
	{

	}

	/**
	 * Order Creation Form
	 *
	 * @return View
	 */
	public function create()
	{
		$type = $this->eavManager->setType("orders");
		$attributes = $type->getAttributes();
		$formOptions = $this->option->setAttributes($attributes)->getOptions();
		dd($formOptions);
		return $this->view(
			'admin.pages.order.create',
			compact('type','attributes','formOptions')
		);
	}
}