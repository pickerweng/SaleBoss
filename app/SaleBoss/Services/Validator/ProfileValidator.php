<?php namespace SaleBoss\Services\Validator;

class ProfileValidator extends AbstractValidator {
    protected $rules = [
        'first_name'    =>  'required',
        'email'         =>  'email|required|unique:users,email',
        'last_name'     =>  'required',
        'password'      =>  'confirmed',
        'old_password'  =>  'required_with:password,password_confirmation',
        'phone_number'  =>  'digits:11',
        'address'       =>  'min:20'
    ];
}