<?php namespace SaleBoss\Models;

use Miladr\Jalali\jDate;

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

    /**
     * Jalali date
     *
     * @param $attr
     * @return string
     */
    public function jalaliDate($attr)
    {
        if (is_null($this->$attr))
        {
            return $this->$attr;
        }
        $timestamp = strtotime($this->$attr);
        return jDate::forge($timestamp)->format('date');
    }

    /**
     * Jalali date with ago format
     *
     * @param $attr
     * @return string
     */
    public function jalaliAgoDate($attr)
    {
        if (is_null($this->$attr))
        {
            return $this->$attr;
        }
        $timestamp = strtotime($this->$attr);
        return jDate::forge($timestamp)->ago();
    }
} 