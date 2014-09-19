<?php

namespace SaleBoss\Services\Presenters;


use Illuminate\Support\Facades\Lang;
use Miladr\Jalali\jDate;

class CommonDataPresenter {

	/**
	 * Evaluates data based on config
	 *
	 * @param $config
	 * @param $data
	 * @return string
	 */
	public function decide($config, $data)
	{
		if(empty($config['type'])) return $data;

		switch ($config['type']){
			case 'date':
				return jDate::forge($data)->format('%B %d، %Y');
			default:
				return $data;
		}
	}

	/**
	 * Evalutes column name
	 *
	 * @param $key
	 * @return mixed
	 */
	public function key($key)
	{
		if(Lang::has('strings.' . $key)){
			return Lang::get('strings.' . $key);
		}else {
			return $key;
		}
	}
} 