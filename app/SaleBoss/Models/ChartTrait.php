<?php namespace SaleBoss\Models;

use Illuminate\Support\Facades\DB;
use Miladr\Jalali\jDateTime;

trait ChartTrait {
	public function scopeChartedOnDateByMonth($query)
	{
		$case = $this->provideSwitchCase();
		return $query->select(DB::raw($case . ' as month, COUNT(*) countable '))->groupBy(DB::raw($case));
	}

	private function provideSwitchCase()
	{
		$sql = "  CASE    ";
		for($i=1;$i<=12;$i++)
		{
			$year = jDateTime::date('o',null,false);
			$start = jDateTime::toGregorian(jDateTime::date('o',null,false),$i,1);
			$end = jDateTime::toGregorian((($i == 12) ? $year + 1  :$year),($i == 12 ? 1 : $i + 1),1);
			$sql .= " WHEN created_at BETWEEN '" . date("o-m-d",strtotime(implode('-',$start)))  . "' AND '" . date("o-m-d",strtotime(implode('-',$end))) . "' THEN " . "'" . $i . "' ";
		}
		return $sql . ' END';
	}
} 