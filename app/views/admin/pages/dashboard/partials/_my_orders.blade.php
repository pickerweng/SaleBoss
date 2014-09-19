<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-check"></i>
            @if(! empty($inMyOrders))
                سفارش هایی که من ایجاد کرده ام
            @else
                سفارش ها
            @endif
        </h3>
	</div>
	<div class="panel-body">
		<div class="list-group">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped tablesorter">
					<thead>
					<tr>
						<th>شناسه # <i class="fa fa-sort"></i></th>
						<th>تاریخ ایجاد</th>
						<th>برای کی؟ <i class="fa fa-sort"></i></th>
						<th>توسط کی؟ <i class="fa fa-sort"></i></th>
						<th><i class="fa fa-sort"></i> صف کاری</th>
						<th class="languageLeft">عملیات</th>
					</tr>
					</thead>
					<tbody>
					@foreach($generatedOrders as $order)
					<tr>
						<td>{{$order->id}}</td>
						<td>{{$order->diff()}}</td>
						<td>
                            @if(! empty($inMyOrders))
                                <a href="{{URL::to('my/orders?customer_id=' . $order->customer->id)}}">{{$order->customer->name()}}</a>
                            @else
                                <a href="{{URL::to('orders?customer_id=' . $order->customer->id)}}">{{$order->customer->name()}}</a>
                            @endif
                        </td>
                        <td>{{$order->creator->getIdentifier()}}</td>
						<td>
							{{$order->state->title}}
							@if($order->completed)
								<label class="label label-success">تکمیل شده</label>
							@elseif($order->suspended)
								<label class="label label-danger">معلق شده</label>
							@else
								<label class="label label-info">تکمیل نشده</label>
							@endif
						</td>
						<td class="languageLeft">
							<a target="_blank" href="{{URL::to('orders/' . $order->id)}}" class="btn btn-success btn-xs">مشاهده</a>
						</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="text-left">
            @if (! empty($inDashboard))
			    <a href="{{URL::to('my/orders')}}">مشاهده همه <i class="fa fa-arrow-circle-left"></i></a>
            @endif
		</div>
	</div>
</div>