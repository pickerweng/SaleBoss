<?php namespace SaleBoss\Services\Validator;

class LeadValidator extends AbstractValidator {
    protected $rules = [
        'phone_number'  =>  'required|unique:leads,phone_number',
        'priority'      =>  'integer',
        'status'        =>  'integer'
    ];
} 