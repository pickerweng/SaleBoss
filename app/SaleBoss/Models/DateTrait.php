<?php namespace SaleBoss\Models;

trait DateTrait {

	/**
	 * Return a date in ago format
	 *
	 * @param string $column
	 * @return string
	 */
	public function diff($column = 'created_at')
	{
		return \jDate::forge($this->$column)->ago();
	}
} 