<?php namespace SaleBoss\Services\Validator;

class UserValidator extends AbstractValidator {

	protected $rules = [
		'email'         =>  'email|required|unique:users,email',
		'mobile'        =>  'required|digits:11',
		'password'      =>  'required|confirmed'
	];

	/**
	 * Dynamic rule implementations
	 *
	 * @param array     $rules
	 */
	public function setRules(array $rules){
		$this->rules = $rules;
	}
}