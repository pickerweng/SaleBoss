<?php

namespace SaleBoss\Services\EavSmartAss;


class EavValidator {
	/**
	 * Check that value has correct attributes if not remote them
	 *
	 * @param $values
	 * @param $attributes
	 * @param $key
	 * @return array
	 */
	public function filterValues($values, $attributes, $key)
	{
		$filtered = [];
		foreach($attributes as $attribute)
		{
			if (! empty($values[$attribute->{$key}])){
				$filtered [$attribute->{$key}] = $values[$attribute->{$key}];
			}
		}
		return $filtered;
	}
} 