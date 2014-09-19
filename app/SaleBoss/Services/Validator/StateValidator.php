<?php namespace SaleBoss\Services\Validator;

class StateValidator extends AbstractValidator{
	protected $rules = [
		'title'     =>  'required|unique:states,title',
		'priority'  =>  'required|integer|min:1'
	];
} 