<?php namespace SaleBoss\Services\Validator;

class GroupValidator extends AbstractValidator {
	protected $rules = [
		'name'          =>  'required',
		'display_name'  =>  'required'
	];
} 