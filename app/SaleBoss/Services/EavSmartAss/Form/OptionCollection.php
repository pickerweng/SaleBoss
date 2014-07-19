<?php
/**
 * Created by PhpStorm.
 * User: bigsinoos
 * Date: 07/19/2014
 * Time: 12:05 PM
 */

namespace SaleBoss\Services\EavSmartAss\Form;

use Illuminate\Support\Collection;

class OptionCollection {

	protected $collection;
	protected $ocValidator;

	public function __construct(
		Collection $collection,
		OptionCollectionValidator $ocValidator
	){
		$this->collection = $collection;
	}

	public function prepareForSave($data)
	{
		$toSave =[];
		foreach($data as $key => $value)
		{
			$tmpSave['key'] = $key;
			$tmpSave['value'] = $value;
			$toSave[] = $tmpSave;
		}
		return json_encode($toSave);
	}
} 