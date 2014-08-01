<?php namespace SaleBoss\Services\Validator;

class UserValidator extends AbstractValidator {

	protected $rules = [
		'email'         =>  'email|required|unique:users,email',
        'first_name'    =>  'required',
        'last_name'     =>  'required',
		'mobile'        =>  'required|digits:11',
		'password'      =>  'required|confirmed'
	];

    protected $updateRules = [
        'email'             =>  'email|required|unique:users,email',
        'first_name'        =>  'required',
        'last_name'         =>  'required',
        'mobile'            =>  'required|digits:11',
        'password'          =>  'confirmed'
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