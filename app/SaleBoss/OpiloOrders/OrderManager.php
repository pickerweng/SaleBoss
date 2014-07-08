<?php

namespace SaleBoss\OpiloOrders;


use SaleBoss\Services\EavSmartAss\EavManagerInterface;

class OrderManager implements OrderManagerInterface {

	const ENTITY_TYPE = 'opilo_orders';

	public function __construct(
		EavManagerInterface $eavManager,
		StateRepositoryInterface $stateRepo,
		OrderRepositoryInterface $orderRepo,
		OrderLogRepositoryInterface $orderLog
	){
		$this->eavManager = $eavManager;
		$this->stateRepo = $stateRepo;
		$this->orderRepo = $orderRepo;

		$this->eavManager->setType(self::ENTITY_TYPE);
	}

	public function getManager()
	{
		return $this->eavManager;
	}

	public function changeOrderstate()
	{

	}


} 