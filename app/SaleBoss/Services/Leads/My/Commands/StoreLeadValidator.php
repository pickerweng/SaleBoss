<?php  namespace SaleBoss\Services\Leads\My\Commands; 
use Laracasts\Validation\FormValidator;

class StoreLeadValidator extends FormValidator {
	protected $rules = [
		'phone'        =>  'required|digits_between:3,20|unique:phones,number',
		'remind_at'    =>   'numeric'
	];
}
