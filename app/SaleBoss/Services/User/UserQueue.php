<?php namespace SaleBoss\Services\User;

use Cartalyst\Sentry\Users\Eloquent\User;
use SaleBoss\Repositories\OrderRepositoryInterface;
use SaleBoss\Repositories\StateRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\EavSmartAss\EavManager;
use SaleBoss\Services\EavSmartAss\EavManagerInterface;

class UserQueue {

	protected $user;
	protected $manager;
	protected $stateRepo;
	protected $orderRepo;

	/**
	 * @param UserRepositoryInterface $userRepo
	 * @param StateRepositoryInterface $stateRepo
	 * @param EavManagerInterface $manager
	 * @param OrderRepositoryInterface $orderRepo
	 */
	public function __construct(
		UserRepositoryInterface $userRepo,
		StateRepositoryInterface $stateRepo,
		EavManagerInterface $manager,
		OrderRepositoryInterface $orderRepo
	){
		$this->userRepo = $userRepo;
		$this->stateRepo = $stateRepo;
		$this->manager = $manager;
		$this->orderRepo = $orderRepo;
	}

	/**
	 * Set user for working on
	 *
	 * @param User $user
	 */
	public function setUser(User $user)
	{
		$this->user = $user ;
	}

	/**
	 * get a summary of user queue
	 *
	 * @return mixed
	 */
	public function summary()
	{
		$perms = $this->getStatePermissions();
		return $this->orderRepo->getAvailableOrders($perms, 5);
	}


	/**
	 * Get permissions of the state
	 *
	 * @return array
	 */
	protected function getStatePermissions()
	{
		$states = $this->stateRepo->getAll();
		$userPermissions = $this->user->getMergedPermissions();
		$perms = [];
		foreach($states as $state)
		{
			if( ! empty($userPermissions['states.' . $state->id])){
				$perms[] = $state->id;
			}
		}
		return $perms;
	}
} 