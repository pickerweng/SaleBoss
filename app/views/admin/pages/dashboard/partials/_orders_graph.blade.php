<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> جدول سفارش ها</h3>
	</div>
	<div class="panel-body">
		<div id="morris-chart-area"></div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		oChart = [];
    	$.each(orderChart, function(index, val){
    		oChart.push(val);
    	});
    	console.log(oChart);
    	Morris.Area({
    		element: 'morris-chart-area',
    		data: oChart,
    		// The name of the data record attribute that contains x-visitss.
    		xkey: 'date',
    		// A list of names of data record attributes that contain y-visitss.
    		ykeys: ['orders'],
    		// Labels for the ykeys -- will be displayed when you hover over the
    		// chart.
    		labels: ['سفارش ها'],
    		// Disables line smoothing
    		smooth: true,
    		parseTime : false
    	});
	});
</script>