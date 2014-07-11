<?php

namespace SaleBoss\Services\Validator;


use Illuminate\Validation\Factory as Validator;

abstract class AbstractValidator implements ValidatorInterface {
	/**
	 * The validator dependency
	 *
	 * @var \Illuminate\Validation\Factory
	 */
	protected $validator;

	/**
	 * Rules to validate for
	 *
	 * @var array
	 */
	protected $rules = [];

	/**
	 * Inject validator
	 *
	 * @param Validator $validator : Illuminate\Validation\Factory
	 * @return \SaleBoss\Services\Validator\AbstractValidator
	 */
	public function __construct ( Validator $validator )
	{
		$this->validator = $validator;
	}

	/**
	 * Do Validation
	 *
	 * @param array $input : array
	 * @param array $messages
	 * @return bool
	 */
	public function isValid( array $input , $messages=[] )
	{
		$this->validator = $this->validator->make( $input , $this->rules, $messages );
		return $this->validator->passes();
	}

	/**
	 * Get validation messages
	 *
	 * @return MessageBag
	 */
	public function getMessages()
	{
		return $this->validator->messages();
	}

	/**
	 * Get First Messages for view
	 * @return \Illuminate\Validation\Factory
	 */
	public function getFirstMessages()
	{
		return $this->validator;
	}
} 