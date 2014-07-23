<?php namespace SaleBoss\Services\User;

use Illuminate\Support\Facades\Config;
use Miladr\Jalali\jDateTime;
use SaleBoss\Models\User;
use SaleBoss\Repositories\EntityRepositoryInterface;
use SaleBoss\Repositories\EntityTypeRepositoryInterface;
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
	protected $typeRepo;
	protected $entityRepo;

	public function __construct(
		UserRepositoryInterface $userRepo,
		EavManager $manager,
		StateRepositoryInterface $stateRepo,
		OrderRepositoryInterface $orderRepo,
		UserQueue $userQueue,
		EntityTypeRepositoryInterface $typeRepo,
		EntityRepositoryInterface $entityRepo
	)
	{
		$this->userRepo = $userRepo;
		$this->manager = $manager;
		$this->orderRepo = $orderRepo;
		$this->stateRepo = $stateRepo;
		$this->userQueue = $userQueue;
		$this->typeRepo = $typeRepo;
		$this->entityRepo = $entityRepo;
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
		$orderChart = $this->orderChart();
		return compact(
			'userQueue',
			'generatedOrders',
			'generatedUsers',
			'hisSales',
			'allOrders',
			'openOrders',
			'orderChart'
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

	protected function orderChart()
	{
		$type = $this->typeRepo->findByMachineName('orders');
		$counts =  $this->entityRepo->countableMonthChart($type)->lists('countable','month');
		$output = [];
		$months = Config::get('jalali_months');
		foreach($months as $key => $month)
		{
			$tmpOutput['date'] = $month;
			$tmpOutput['orders'] = ! empty($counts[$key]) ? $counts[$key] : 0;
			$output[] = $tmpOutput;
		}
		return $output;
	}


} 