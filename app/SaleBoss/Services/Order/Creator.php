<?php namespace SaleBoss\Services\Order;

use Illuminate\Events\Dispatcher;
use SaleBoss\Repositories\OrderRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;

class Creator {

	protected $orderRepo;
	protected $events;
	protected $listener;
	protected $userRepo;

	public function __construct(
		OrderRepositoryInterface $orderRepo,
		Dispatcher $event,
		UserRepositoryInterface $userRepo
	){
		$this->orderRepo = $orderRepo;
		$this->events = $event;
		$this->userRepo = $userRepo;
	}

	public function setListener($listener)
	{
		$this->listener = $listener;
		return $this;
	}

	public function salerCreate()
	{

	}
} 