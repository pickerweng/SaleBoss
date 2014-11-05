<?php namespace SaleBoss\Services\Validator;

class LeadValidator extends AbstractValidator {
    protected $rules = [
        'phone_number'  =>  'required|unique:phones,number',
        'priority'      =>  'integer',
        'status'        =>  'integer'
    ];
} 