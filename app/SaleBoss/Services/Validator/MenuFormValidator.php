<?php

namespace SaleBoss\Services\Validator;


class MenuFormValidator extends AbstractValidator {
	protected $rules = [
		'title'     =>  'required',
		'uri'       =>  'required',
		'ids'       =>  'required'
	];
} 