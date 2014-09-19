<a href="{{URL::to('customers/' . $customer->id . '/edit')}}" class="btn operation-margin btn-xs pull-left btn-info">ویرایش</a>
<a target="_blank" href='{{URL::to("customers/{$customer->id}")}}' class="btn operation-margin btn-xs pull-left btn-success">مشاهده</a>
<a target="_blank" href='{{URL::to("orders?customer_id={$customer->id}")}}' class="btn operation-margin btn-xs pull-left btn-warning">سفارش ها</a>
<a target="_blank" href='{{URL::to("orders/create/{$customer->id}")}}' class="btn operation-margin btn-xs pull-left btn-danger">ایجاد سفارش</a>