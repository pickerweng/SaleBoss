<?php namespace SaleBoss\Services\Validator;

class AttributeValidator extends AbstractValidator {
	protected $rules = [
		'display_name'      =>  'required',
		'machine_name'      =>  'required|unique:attributes,machine_name',
		'field_type'        =>  'string',
		'order'             =>  'integer',
		'validation'        =>  'validation',
		'options'           =>  'array'
	];
} 