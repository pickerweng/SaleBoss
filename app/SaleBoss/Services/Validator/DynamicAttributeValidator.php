<?php namespace SaleBoss\Services\Validator;

class DynamicAttributeValidator extends AbstractValidator {

	protected $rules = [];

	/**
	 * Set Dynamic rules
	 *
	 * @param $key
	 * @param $rules
	 */
	public function setRules($key , $rules)
	{
		$rules = $this->filterRules($rules);
		$this->rules[$key] = $rules;
	}

	/**
	 * Filter available rules if they are not valid
	 *
	 * @param $rules
	 * @return array
	 */
	protected function filterRules($rules)
	{
		$avalableConfig = Config::get('validation_rules');
		$rules = [];
		foreach($avalableConfig as $valRule)
		{
			if (in_array($valRule, $rules)) $rules[] = $valRule;
		}
		return $rules;
	}
} 