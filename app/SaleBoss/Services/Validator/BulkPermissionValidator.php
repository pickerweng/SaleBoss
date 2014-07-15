<?php namespace SaleBoss\Services\Validator;

class BulkPermissionValidator {

	protected $errors;

	/**
	 * Validate data
	 *
	 * @param $data
	 * @return boolean
	 */
	public function isValid($data)
	{
		if(is_array($data)){ return false;}
		foreach($data as $item => $value)
		{
			if (!is_numeric($item)){
				$this->setErrors();
				return false;
			}
		}
		return true;
	}

	/**
	 * Set error
	 *
	 * @return array
	 */
	public function setErrors()
	{
		return $this->errors = [Lang::get('messages.operation_error')];
	}

	/**
	 * Get errors
	 *
	 * @return array
	 */
	public function getErrors ()
	{
		return $this->errors;
	}
} 