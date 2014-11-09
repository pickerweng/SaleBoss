<?php  namespace SaleBoss\Services\Leads\My\Commands; 
use Laracasts\Validation\FormValidator;

class StoreLeadValidator extends FormValidator {
	protected $rules = [
		'phone'        =>  'required|regex:/^[0-9]+$/|digits_between:4,11|unique:phones,number',
		'tag'          =>  'required|integer|not_in:182',
		'remind_at'    =>   'numeric'
	];
}
