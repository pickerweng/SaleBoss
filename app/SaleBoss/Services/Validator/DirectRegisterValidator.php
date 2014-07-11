<?php

namespace SaleBoss\Services\Validator;

class DirectRegisterValidator extends AbstractValidator {
	protected $rules = [
		'email'         =>  'required|email',
		'password'      =>  'required|confirmed',
		'first_name'    =>  'required',
		'last_name'     =>  'required',
		'mobile'        =>  'required'
	];
} 