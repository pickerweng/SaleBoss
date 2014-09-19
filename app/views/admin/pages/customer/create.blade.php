@extends('admin.layouts.default')
@section('title')
	@parent | ایجاد مشتری جدید
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('my/customers')}}"><i class="fa fa-user"></i> مشتریان</a></li>
	<li class="active"><i class="fa fa-plus"></i> ایجاد</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        @include('admin.pages.customer._form')
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.customer-form .to-order-submit').click(function(e){
            $('.customer-form .to-order').val('1');
            $('form.customer-form').submit();
        });
    });
</script>
@stop