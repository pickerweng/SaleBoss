<?php namespace SaleBoss\Services\Validator;

class GroupValidator extends AbstractValidator {
	protected $rules = [
		'name'          =>  'required|unique:groups,name',
		'display_name'  =>  'required'
	];
} 