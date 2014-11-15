<div style="margin-bottom: 10px;">
          <div class="table-header Nassim Nassim700 NassimTitle panelColor" style="padding-right: 10px;" >
                <i class="fa fa-user"></i> @if(! empty($inMyOrders))
                                                           سفارش هایی که من ایجاد کرده ام
                                                       @else
                                                           سفارش ها
                                                       @endif
          </div>
          <div>
                <div class="form-inline">
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
	                                            <label class="label label-sm label-success">تکمیل شده</label>
	                                        @elseif($order->suspended)
	                                            <label class="label label-sm label-danger">معلق شده</label>
	                                        @else
	                                            <label class="label label-sm label-info">تکمیل نشده</label>
	                                        @endif
	                                    </td>
	                                    <td class="languageLeft">
	                                        <a class="blue" href="{{URL::to('orders/' . $order->id)}}">
                                                <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                            </a>
	                                    </td>
	                                </tr>
                                @endforeach
	                        </tbody>
	                        <tfoot>
								<tr role="row">
									<td colspan="6" style="text-align: left">
										@if (! empty($inDashboard))
                                            <a href="{{URL::to('my/orders')}}">مشاهده همه <i class="fa fa-arrow-circle-left"></i></a>
                                        @endif
									</td>
								</tr>
	                        </tfoot>
                    </table>
                </div>
          </div>
</div>