<?php namespace SaleBoss\Services\Validator;

class CustomerCreationValidator extends  AbstractValidator{
    protected $rules = [
        'email'         =>  'email|required|unique:users,email',
        'mobile'        =>  'unique:users,mobile',
		'tell'			=>	'unique:users,tell'
    ];
}