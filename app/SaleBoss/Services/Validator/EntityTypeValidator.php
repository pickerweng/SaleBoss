<?php namespace SaleBoss\Services\Validator;

class EntityTypeValidator extends AbstractValidator{
	protected $rules = [
		'display_name'  =>  'required'
	];
} 