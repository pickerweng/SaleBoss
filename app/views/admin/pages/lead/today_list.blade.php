<div class="panel panel-info">
	<div class="panel-heading">
		لیدهای امروز
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-12">
				@foreach($todayList as $lead)
					{{$lead->id}}
				@endforeach
			</div>
		</div>
	</div>
</div>