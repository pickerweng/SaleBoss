
<div class="table-header Nassim Nassim700 NassimTitle panelColor" style="padding-right: 10px;" >
                <i class="fa fa-user"></i> صف کارهای مربوط به من
          </div>
          <table class="table table-striped table-bordered table-hover tableFontSize12">
                 <thead>
                     <tr role="row">
                          <th style="padding: 13px">شناسه # </th>
                          <th>تاریخ ایجاد</th>
                          <th>برای کی؟ </th>
                          <th>توسط کی؟ </th>
                          <th> صف کاری</th>
                          <th class="languageLeft">عملیات</th>
                     </tr>
                 </thead>
                 <tbody>
                    @foreach($userQueue as $queue)
	                    <a href="{{URL::to('orders/' . $queue->id)}}" class="list-group-item">
	                        <span class="badge"><i class="fa fa-clock-o"></i> {{$queue->diff()}}</span>
	                        <i class="fa fa-child"></i>
	                        سفارش شماره ی{{$queue->id}} برای {{$queue->customer->name()}}
	                    </a>
                    @endforeach
                 </tbody>
          </table>
{{--<div class="panel panel-primary">--}}
	{{--<div class="panel-heading">--}}
		{{--<h3 class="panel-title"><i class="fa fa-check"></i> صف کارهای مربوط به من</h3>--}}
	{{--</div>--}}
	{{--<div class="panel-body">--}}
		{{--<div class="list-group">--}}
			{{--@foreach($userQueue as $queue)--}}
			{{--<a href="{{URL::to('orders/' . $queue->id)}}" class="list-group-item">--}}
				{{--<span class="badge"><i class="fa fa-clock-o"></i> {{$queue->diff()}}</span>--}}
				{{--<i class="fa fa-child"></i>--}}
				{{--سفارش شماره ی{{$queue->id}} برای {{$queue->customer->name()}}--}}
			{{--</a>--}}
			{{--@endforeach--}}
		{{--</div>--}}
		{{--<div class="text-left">--}}
			{{--<!--a href="#">مشاهده همه صف <i class="fa fa-arrow-circle-left"></i></a-->--}}
		{{--</div>--}}
	{{--</div>--}}
{{--</div>--}}