<?php namespace SaleBoss\Services\Validator;

class LeadImporterValidator extends AbstractValidator {
    protected $rules = [
        'file'      =>  'required|max:4000|mimes:csv,xls,xlsx,txt'
    ];
} 