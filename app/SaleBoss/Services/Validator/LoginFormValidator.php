<?php

namespace SaleBoss\Services\Validator;


class LoginFormValidator extends AbstractValidator {

	protected $rules = [
		'identifier'  =>  'required',
		'password'  =>  'required'
	];
} 