<?php

namespace SaleBoss\Services\Authenticator;


use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\WrongPasswordException;
use SaleBoss\Services\Authenticator\Exceptions\AuthenticatorException;
use SaleBoss\Services\Authenticator\Exceptions\InvalidCredentialsException;
use SaleBoss\Services\Authenticator\Exceptions\ValidationException;
use SaleBoss\Services\Validator\LoginFormValidator;

class SentryAuthenticator implements AuthenticatorInterface {

	protected $sentry;
	protected $validationErrors;
	protected $loginValidator;

	/**
	 * @param Sentry $sentry
	 * @param LoginFormValidator $loginValidator
	 */
	public function __construct(
		Sentry $sentry,
		LoginFormValidator $loginValidator
	){
		$this->sentry = $sentry;
		$this->loginValidator = $loginValidator;
	}

	/**
	 * @param $data
	 * @return bool
	 * @throws AuthenticatorException
	 */
	public function attempt($data)
	{
		$valid = $this->loginValidator->isValid($data);
		if (! $valid ){
			$this->setValidationErrors($this->loginValidator->getMessages());
			throw new ValidationException("Validation error");
		}
		$userId = $data['identifier'];

		try {
			Sentry::authenticate([
				'email' => $data['identifier'],
				'password' => $data['password'],
				empty($data['remember_me']) ? false : true
			]);
			return true;
		}catch (UserNotFoundException $e){
			throw new InvalidCredentialsException("User not found");
		}catch(WrongPasswordException $e){
			throw new InvalidCredentialsException("Password wrong!");
		}

	}

	/**
	 * @param $message
	 */
	protected function setValidationErrors($message)
	{
		$this->validationErrors = $message;
	}

	/**
	 * @return mixed
	 */
	public function getErrors()
	{
		return $this->validationErrors;
	}
}