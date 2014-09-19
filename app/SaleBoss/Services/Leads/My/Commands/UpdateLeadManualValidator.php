<?php namespace SaleBoss\Services\Leads\My\Commands; 

use Laracasts\Validation\FormValidator;

class UpdateLeadManualValidator extends FormValidator
{
    protected $rules = [
        'phone'        =>  'required|digits_between:3,20|unique:phones,number',
        'remind_at'    =>   'numeric'
    ];

    public function setUpdate ($id)
    {
        $this->rules['phone'] = $this->rules['phone'] . ",{$id}";
        return $this;
    }


}
