<?php namespace SaleBoss\Services\User;

use SaleBoss\Models\User;
use SaleBoss\Repositories\OrderRepositoryInterface;
use SaleBoss\Repositories\StateRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\EavSmartAss\EavManager;

class Dashboard implements DashboardInterface {

	protected $userRepo;
	protected $user;
	protected $stateRepo;
	protected $orderRepo;
	protected $userQueue;

	public function __construct(
		UserRepositoryInterface $userRepo,
		EavManager $manager,
		StateRepositoryInterface $stateRepo,
		OrderRepositoryInterface $orderRepo,
		UserQueue $userQueue
	)
	{
		$this->userRepo = $userRepo;
		$this->manager = $manager;
		$this->orderRepo = $orderRepo;
		$this->stateRepo = $stateRepo;
		$this->userQueue = $userQueue;
	}

	public function setUser(User $user)
	{
		$this->user = $user;
	}

	public function getHisDash(){
		$userQueue = $this->userQueue();
		$generatedUsers = $this->generatedUsers();
		$generatedOrders = $this->generatedOrders();
		$hisSales = $this->hisSales();
		$allOrders = $this->allOrders();
		$openOrders = $this->openOrders();
		return compact(
			'userQueue',
			'generatedOrders',
			'generatedUsers',
			'hisSales',
			'allOrders',
			'openOrders'
		);

	}

	protected function userQueue()
	{
		$this->userQueue->setUser($this->user);
		return $this->userQueue->summary();
	}

	protected function generatedUsers()
	{
		return $this->userRepo->getGeneratedUsers($this->user,5);
	}

	protected function generatedOrders()
	{
		return $this->orderRepo->getGeneratedOrders($this->user, 5);
	}

	protected function hisSales()
	{

	}

	protected function allOrders()
	{

	}

	protected function openOrders()
	{

	}


} 