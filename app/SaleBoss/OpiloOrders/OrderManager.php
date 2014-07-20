<?php namespace SaleBoss\OpiloOrders;

use SaleBoss\Services\EavSmartAss\EavManagerInterface;

class OrderManager implements OrderManagerInterface {

	const ENTITY_TYPE = 'opilo_orders';

	/**
	 *
	 * @param EavManagerInterface $eavManager
	 * @param StateRepositoryInterface $stateRepo
	 * @param OrderRepositoryInterface $orderRepo
	 * @param OrderLogRepositoryInterface $orderLog
	 */
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

	/**
	 * @return EavManager
	 */
	public function getEavManager()
	{
		return $this->eavManager;
	}
} 