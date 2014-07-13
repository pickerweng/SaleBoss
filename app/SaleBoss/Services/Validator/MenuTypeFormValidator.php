<?php
namespace SaleBoss\Services\Validator;


class MenuTypeFormValidator  extends  AbstractValidator{
	protected $rules = [
		'display_name'  =>  'required',
		'machine_name'  =>  'required|alpha_dash|unique:menu_types,machine_name'
	];
} 