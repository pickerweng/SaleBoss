<?php  namespace SaleBoss\Services\Leads\My\Commands; 
use Laracasts\Validation\FormValidator;

class StoreLeadValidator extends FormValidator {
	protected $rules = [
		'name'  =>  'required',
		'description'   =>  'required',
		'phone'        =>  'required|digits_between:3,20',
	];
} 