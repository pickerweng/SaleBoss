<?php namespace Controllers;

use Miladr\Jalali\jDate;
use Miladr\Jalali\jDateTime;
use SaleBoss\Services\Menu\Facades\MenuBuilder;

class HomeController extends BaseController {

    public function __construct(
        MenuBuilder $builder
    ){
        $this->builder = $builder;
    }

	public function getIndex()
	{
		$ranges = [];
		$sql = "CASE    ";
		for($i=1;$i<=12;$i++)
		{
			$year = jDateTime::date('o',null,false);
			$start = jDateTime::toGregorian(jDateTime::date('o',null,false),$i,1);
			$end = jDateTime::toGregorian((($i == 12) ? $year + 1  :$year),($i == 12 ? 1 : $i + 1),1);
			$sql .= " WHEN created_at BETWEEN '" . strtotime(implode('-',$start)) . "' AND '" . strtotime(implode('-',$end)) ."' THEN '" . "' . $i .' ";
		}
		return $sql . ' END';
	}

}
