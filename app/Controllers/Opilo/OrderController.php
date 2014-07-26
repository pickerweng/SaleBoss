<?php

namespace Controllers\Opilo;

use Controllers\BaseController;
use Illuminate\Support\Facades\Input;
use SaleBoss\OpiloOrders\OrderCreator;
use SaleBoss\OpiloOrders\OrderCreatorListenerInterface;
use SaleBoss\Services\EavSmartAss\EavManagerInterface;
use SaleBoss\Services\EavSmartAss\Form\FormOptionProvider;

class OrderController extends BaseController implements OrderCreatorListenerInterface{

	protected $eavManager;
	protected $option;
	protected $orderCreator;

	public function __construct(
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
		$this->orderCreator->setListener($this);
		$this->orderCreator->setData(Input::all());
		return $this->orderCreator->create();
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
		return $this->view(
			'admin.pages.order.create',
			compact('type','attributes','formOptions')
		);
	}

	/**
	 * What to do when an order fails to be saved
	 *
	 * @param $messages
	 * @return mixed
	 */
	public function onCreateFail($messages)
	{
		return $this->redirectBack()->withErrors($messages);
	}

	/**
	 * What do when an order is created
	 *
	 * @param $message
	 * @return mixed
	 */
	public function onCreateSuccess($message)
	{
		return $this->redirectTo('opilo-orders/create')->with('success_message',$message);
	}
}