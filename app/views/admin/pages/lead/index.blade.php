@extends('admin.layouts.default')
@section('title')
	@parent | لیست لیدها
@stop
@section('breadcrumb')
	@parent
	<li class="active"><i class="fa fa-list"></i> لیدها</li>
@stop
@section('intro')
    @include('admin.pages.lead.partials._list_intro')
@stop
@section('content')
<div class="row">
    <div class="col-sm-12">
        @include('admin.pages.lead.partials._search')
    </div>
</div>
@if (! ThrottleL::minLimit() || ! ThrottleL::oneUndefined())
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-info">
            @if(! ThrottleL::minLimit())
                <p>تو هر 5 دقیقه میشه یه لید رو قفل کرد.</p>
            @endif
            @if(! ThrottleL::oneUndefined())
                <p>نمیشه بیشتر از یک لید با وضعیت نامشخص داشت. لیدتون رو انتخاب کنید کارتون رو باهاش انجام بدید و تو وضعیتش تغییر ایجاد کنید.</p>
            @endif
        </div>
    </div>
</div>
@endif
<div class="row">
        @if(! $list->isEmpty())
            @include('admin.pages.lead.list')
        @else
            <div class="alert alert-info">
                 <p>لیدی وجود ندارد.</p>
            </div>
        @endif
	</div>
</div>
@stop