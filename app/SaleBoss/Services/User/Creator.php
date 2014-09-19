<?php
/**
 * Created by PhpStorm.
 * User: bigsinoos
 * Date: 07/13/2014
 * Time: 01:20 PM
 */

namespace SaleBoss\Services\User;


use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use SaleBoss\Models\User;
use SaleBoss\Repositories\Exceptions\InvalidArgumentException;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Repositories\GroupRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;
use SaleBoss\Services\Validator\ProfileValidator;
use SaleBoss\Services\Validator\UserValidator;

class Creator {

	protected $userRepo;
    protected $groupRepo;
    protected $userValidator;
    protected $profileValidator;
    protected $events;
    protected $auth;

    /**
     * @param UserRepositoryInterface                       $userRepo
     * @param GroupRepositoryInterface                      $roleRepo
     * @param UserValidator                                 $userValidator
     * @param AuthenticatorInterface                        $auth
     * @param Dispatcher                                    $event
     * @param \SaleBoss\Services\Validator\ProfileValidator $profileValidator
     */
	public function __construct(
		UserRepositoryInterface $userRepo,
		GroupRepositoryInterface $roleRepo,
		UserValidator $userValidator,
		AuthenticatorInterface $auth,
		Dispatcher $event,
        ProfileValidator $profileValidator
	){
		$this->userRepo = $userRepo;
		$this->groupRepo = $roleRepo;
		$this->userValidator = $userValidator;
		$this->auth = $auth;
		$this->events = $event;
        $this->profileValidator = $profileValidator;
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
            $data['activated'] = true;
			$user = $this->userRepo->create($data);
			$this->events->fire('user.created',array($user));
            if (Sentry::getUser()->hasAnyAccess(['user.change_groups']))
            {
                $this->groupRepo->addGroupsToUser($user, $groups);
            }
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
		$this->userValidator->setCurrentIdFor('email',$id);
		if (!$valid = $this->userValidator->isUpdateValid($info))
		{
			return $listener->onUpdateFail($this->userValidator->getMessages());
		}
		$groups = ! empty($info['roles']) ? $info['roles'] : [];
		$info = $this->filterData($info);
		try{
			$user = $this->userRepo->update($id, $info);
            if (Sentry::getUser()->hasAnyAccess(['user.change_groups']))
            {
                $this->groupRepo->removeUserGroups($user);
                $this->groupRepo->addGroupsToUser($user, $groups);
            }
			return $listener->onUpdateSuccess();
		}catch (NotFoundException $e){
			return $listener->onUpdateNotFound();
		}catch (InvalidArgumentException $e){
			print $e->getMessage();exit();
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

    public function updateMe(User $user,array $input, UpdateListenerInterface $listener)
    {
        $this->profileValidator->setCurrentIdFor('email',$user->id);
        if (! $valid = $this->profileValidator->isValid($input))
        {
            return $listener->onUpdateFail($this->profileValidator->getMessages());
        }
        if (!empty($input['password']))
        {
            if (! $user->checkPassword($input['old_password']))
            {
                return $listener->onUpdateFail([Lang::get("messages.old_password_incorrect")]);
            }
        }
        unset($input['old_password']);
        unset($input['password_confirmation']);
        try {
            $this->userRepo->update($user->id, $input);
            return $listener->onUpdateSuccess(Lang::get("messages.operation_success"));
        }catch (NotFoundException $e){
            return $listener->onUpdateNotFound();
        }catch( RepositoryException $e){

            return $listener->onUpdateFail([Lang::get("messages.database_error")]);
        }
    }

}