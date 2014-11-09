<?php  namespace SaleBoss\Services\Leads\My\Commands; 
use Laracasts\Validation\FormValidator;

class StoreLeadValidator extends FormValidator {
	protected $rules = [
		'phone'        =>  'required|unique:phones,number',
		'tag'          =>  'required|integer|not_in:182',
		'remind_at'    =>   'numeric'
	];
}
