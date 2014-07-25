<?php namespace SaleBoss\Services\Validator;

class CustomerCreationValidator extends  AbstractValidator{
    protected $rules = [
        'first_name'    =>  'required',
        'last_name'     =>  'required',
        'email'         =>  'email|required|unique:users,email',
        'mobile'        =>  'required'
    ];
}