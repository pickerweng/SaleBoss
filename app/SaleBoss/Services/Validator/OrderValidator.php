<?php namespace SaleBoss\Services\Validator;

class OrderValidator extends AbstractValidator {
	protected $rules = [
		'panel_type'        =>  'required|integer',
        'sms_price'         =>  'integer|min:0',
        'sms_quantity'      =>  'integer|min:0',
        'payment_type'      =>  'integer',
        'cart_number'       =>  'digits:4',
        'panel_price'       =>  'required|integer|min:0',
	];
}