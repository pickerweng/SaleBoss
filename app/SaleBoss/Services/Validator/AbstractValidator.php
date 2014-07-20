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
	 * Rules for update validation
	 *
	 * @var array
	 */
	protected $updateRules = [];

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

	/**
	 * Sets unique control except id
	 *
	 * @param $key
	 * @param $id
	 * @return null
	 */
	public function setCurrentIdFor($key,$id)
	{
		if (empty($this->updateRules))
		{
			$this->rules[$key] = $this->rules[$key] . ',' . $id;
		}
		else
		{
			$this->rules[$key] = $this->upadteRules[$key] . ',' . $id;
		}
	}

	/**
	 * Validate against update
	 *
	 * @param array $input
	 * @param $messages
	 * @return boolean
	 */
	public function isUpdateValid(array $input, $messages)
	{
		$this->validator = $this->validator->make( $input , $this->updateRules, $messages );
		return $this->validator->passes();
	}
} 