<?php
/**
 * Created by PhpStorm.
 * User: bigsinoos
 * Date: 07/13/2014
 * Time: 01:20 PM
 */

namespace SaleBoss\Services\User;


use SaleBoss\Repositories\GroupRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\Validator\UserValidator;

class Creator {

	protected $userRepo;

	/**
	 * @param UserRepositoryInterface $userRepo
	 * @param GroupRepositoryInterface $roleRepo
	 * @param UserValidator $userValidator
	 */
	public function __construct(
		UserRepositoryInterface $userRepo,
		GroupRepositoryInterface $roleRepo,
		UserValidator $userValidator
	){
		$this->userRepo = $userRepo;
		$this->groupRepo = $roleRepo;
		$this->userValidator = $userValidator;
	}

	/**
	 * Create a user and return response
	 *
	 * @param array $data
	 * @param CreatorListenerInterface $listener
	 * @return mixed
	 */
	public function create (
		array $data,
		CreatorListenerInterface $listener
	)
	{
		$valid = $this->userValidator->isValid($data);
		if (!$valid)
		{
			return $listener->onCreateFail($this->userValidator->getMessages());
		}
	}

} 