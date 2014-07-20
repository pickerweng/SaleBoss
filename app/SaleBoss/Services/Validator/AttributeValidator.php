<?php namespace SaleBoss\Services\Validator;

class AttributeValidator extends AbstractValidator {
	protected $rules = [
		'display_name'      =>  'required',
		'machine_name'      =>  'required|unique:attributes,machine_name',
		'order'             =>  'integer',
		'form_type'         =>  'required'
	];
} 