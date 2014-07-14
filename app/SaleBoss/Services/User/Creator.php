<?php
/**
 * Created by PhpStorm.
 * User: bigsinoos
 * Date: 07/13/2014
 * Time: 01:20 PM
 */

namespace SaleBoss\Services\User;


use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use SaleBoss\Repositories\Exceptions\InvalidArgumentException;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\GroupRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;
use SaleBoss\Services\Validator\UserValidator;

class Creator {

	protected $userRepo;

	/**
	 * @param UserRepositoryInterface $userRepo
	 * @param GroupRepositoryInterface $roleRepo
	 * @param UserValidator $userValidator
	 * @param AuthenticatorInterface $auth
	 * @param Dispatcher $event
	 */
	public function __construct(
		UserRepositoryInterface $userRepo,
		GroupRepositoryInterface $roleRepo,
		UserValidator $userValidator,
		AuthenticatorInterface $auth,
		Dispatcher $event
	){
		$this->userRepo = $userRepo;
		$this->groupRepo = $roleRepo;
		$this->userValidator = $userValidator;
		$this->auth = $auth;
		$this->events = $event;
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
	){
		$valid = $this->userValidator->isValid($data);

		if (!$valid)
		{
			return $listener->onCreateFail($this->userValidator->getMessages());
		}

		$groups = empty($data['roles'])  ? [] : $data['roles'];
		$data = $this->filterData($data);

		if ($this->auth->check())
		{
			$user = $this->auth->user();
			$data['creator_id'] = $user->id;
		}

		try {
			$user = $this->userRepo->create($data);
			$this->events->fire('user.created',array($user));
			$this->groupRepo->addGrooupsToUser($user, $groups);
			return $listener->onCreateSuccess();
		}catch(InvalidArgumentException $e){
			Log::error($e->getMessage());
			return $listener->onCreateFail([Lang::get('messages.operation_error')]);
		}
	}

	/**
	 * Update a user in repository
	 *
	 * @param $id
	 * @param array $info
	 * @param UpdateListenerInterface $listener
	 * @return mixed
	 */
	public function update(
		$id,
		array $info ,
		UpdateListenerInterface $listener
	){
		if (!$valid = $this->userValidator->isValid($info))
		{
			return $listener->onUpdateFail($this->userValidator->getMessages());
		}
		try{
			$this->userRepo->update($id, $info);
			return $listener->onUpdateSuccess();
		}catch (NotFoundException $e){
			return $listener->onUpdateNotFound();
		}catch (InvalidArgumentException $e){
			print $e->getMessage();
			return $listener->onUpdateFail([Lang::get('messages.operation_failed')]);
		}
	}

	/**
	 * Filter data
	 *
	 * @param $data
	 * @return mixed
	 */
	protected function filterData($data)
	{
		unset($data['password_confirmation']);
		unset($data['roles']);
		return $data;
	}

} 