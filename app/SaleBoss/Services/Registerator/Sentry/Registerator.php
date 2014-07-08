<?php

namespace SaleBoss\Services\Registerator\Sentry;

use Cartalyst\Sentry\Groups\GroupNotFoundException;
use Cartalyst\Sentry\Sentry;
use Cartalyst\Sentry\Users\UserExistsException as SentryUserExistsException;
use SaleBoss\Services\Registerator\Exceptions\RegisterNeedException;
use SaleBoss\Services\Registerator\Exceptions\UserExistsException;
use SaleBoss\Services\Registerator\RegisteratorInterface;
use SaleBoss\Services\Validator\DirectRegisterValidator;

class Registerator implements RegisteratorInterface {

	protected $sentry;
	protected $directValidator;
	protected $errors;
	protected $user;

	public function __construct(
		Sentry $sentry,
		DirectRegisterValidator $directValidator
	){
		$this->sentry = $sentry;
		$this->directValidator = $directValidator;
	}

	/**
	 * Register the user with sentry
	 *
	 * @param $data
	 * @param array $roles
	 * @param bool $activated
	 * @throws \SaleBoss\Services\Registerator\Exceptions\RegisterNeedException
	 * @return bool|void
	 */
	public function directRegister(
		$data,
		array $roles = ['authenticated'],
		$activated = true
	){
		$valid = $this->directValidator->isValid($data);

		if ( ! $valid) {
			$this->setErrors($this->directValidator->getMessages());
			throw new RegisterNeedException("Validation errors!");
		}

		$this->register(
			$this->prepareSentryData($data, $activated),
			$roles
		);
	}

	/**
	 * @param array $data
	 * @param $roles
	 * @throws \SaleBoss\Services\Registerator\Exceptions\RegisterException
	 * @throws \SaleBoss\Services\Registerator\Exceptions\UserExistsException
	 */
	protected function register(array $data, $roles)
	{
		try {
			$this->user = $this->sentry->createUser($data);
			$this->addRoles($roles);
		}catch (SentryUserExistsException $e)
		{
			throw new UserExistsException("User Exsists!");
		}
	}

	/**
	 * @param $roles
	 * @return bool
	 */
	protected function addRoles($roles)
	{
		if (is_null($this->user))
			return false;

		foreach($roles as $role)
		{
			try {
				$group = $this->sentry->findGroupByName($role);
				$this->user = $this->user->addGroup($group);
			}catch( GroupNotFoundException $e){
				continue;
			}

		}
		return $this->user;
	}

	/**
	 * @param $data
	 * @param $activated
	 * @return array
	 */
	protected function prepareSentryData($data , $activated)
	{
		$sentryData = [
			'email'         =>  $data['email'],
			'password'      =>  $data['password'],
			'activated'     =>  $activated,
			'first_name'    =>  empty($data['first_name']) ? null : $data['first_name'],
			'last_name'     =>  empty($data['last_name'])  ? null : $data['last_name'],
			'mobile'        =>  empty($data['mobile']) ? null : $data['mobile']
		];
		return $sentryData;
	}

	/**
	 * User registers him selfs with a deligator (a saler for example)
	 *
	 * @param $data
	 * @param array $roles
	 * @param bool $activated
	 * @param bool $suspended
	 * @return boolean
	 */
	public function deligatorRegister($data, array $roles = ['authenticated'], $activated = true, $suspended = false)
	{
		// TODO: Implement deligatorRegister() method.
	}

	/**
	 *  Errors on validation
	 *
	 * @param  $errors
	 */
	protected function setErrors($errors)
	{
		$this->errors = $errors;
	}

	/**
	 * @return mixed
	 */
	public function getErrors()
	{
		return $this->errors;
	}
}