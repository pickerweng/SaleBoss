<?php namespace SaleBoss\Models;

use Illuminate\Support\Facades\DB;

trait ChartTrait {
	public static  function scopeChartedOnDateByMonth($query)
	{
			return $query->select(DB::raw(
					"CASE
					WHEN id <  2 Then '1'
					WHEN id >  2 THEN '2'
			    End as month,
			    Count(*) count")
			)->groupBy(DB::raw(
				"CASE
					WHEN id <  2 Then 'lowe than 2'
					WHEN id >  2 THEN 'bigger than 23'
			    End"
			));
	}

	private function provideJalaliDates()
	{
		$dates = [];
	}
} 