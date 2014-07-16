<?php namespace SaleBoss\Services\Validator;

class EntityTypeValidator extends AbstractValidator{
	protected $rules = [
		'display_name'  =>  'required',
		'machine_name'  =>  'required|alpha_dash|unique:entity_types,machine_name',
	];
} 