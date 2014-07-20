<?php

namespace SaleBoss\Services\Authenticator\Exceptions;


class ValidationException extends AuthenticatorException {

	protected $validationErrors;

	/**
	 * @param $errors
	 * @return void
	 */
	public function setErrors($errors)
	{
		$this->validationErrors = $errors;
	}

	/**
	 * @return mixed
	 */
	public function getErrors()
	{
		return $this->validationErrors;
	}
} 