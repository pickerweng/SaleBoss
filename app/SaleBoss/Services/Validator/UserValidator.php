<?php namespace SaleBoss\Services\Validator;

class UserValidator extends AbstractValidator {
	protected $rules = [
		'email'         =>  'email|required',
		'first_name'    =>  'required',
		'last_name'     =>  'required',
		'mobile'        =>  'required|integer|min:1111111111|max:9999999999'
	];
} 