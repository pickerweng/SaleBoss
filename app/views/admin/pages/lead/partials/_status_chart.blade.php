<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> چارت وضعیت لید</h3>
	</div>
	<div class="panel-body">
		<div id="morris-status-chart-area"></div>
		<p class="text-center status-chart" >

		</p>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		oChart = [];
		totalCount = 0;
    	$.each(myLeadStats, function(index, val){
    		stat = new Object();
    		stat = {
    			label : Common.getStatuses(val.status),
    			value : val.total
    		}
    		totalCount = totalCount + val.total;
    		oChart.push(stat);
    	});
    	$(".status-chart").html("چارت وضعیت لید من از مجموع " + totalCount + " لید")
    	console.log(oChart);
		Morris.Donut({
			element: 'morris-status-chart-area',
			data: oChart,
			formatter: function (y) {
				return Math.round(( y / totalCount) * 100) + "%";
			}
		});
		$(".")
	});
</script>