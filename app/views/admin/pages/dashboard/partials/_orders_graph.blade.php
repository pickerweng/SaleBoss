 <div class="widget-box">
   <div class="widget-header"><h5 class="Nassim Nassim700 NassimTitle"><i class="fa fa-bar-chart-o"></i> نمودار سفارش ها</h5></div>
   <div class="widget-body">
        <div id="morris-chart-area"></div>
   </div>
 </div>
<script type="text/javascript">
	$(document).ready(function(){
		oChart = [];
    	$.each(orderChart, function(index, val){
    		oChart.push(val);
    	});
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