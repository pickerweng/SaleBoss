@extends('admin.layouts.default')
@section('title')
	@parent |لیست لیدهای
@stop

@section('breadcrumb')
	@parent
	<li class="active"><i class="fa fa-list"></i> لیست لیدهای
@stop

@section('intro')

@stop

@section('content')
<div class="table-responsive">
    <table class="table table-hover table-stripped my-lead-table">
        <thead>
        <tr>
            <th><i class="fa fa-flag"></i> شناسه</th>
            <th><i class="fa fa-user"></i> نام شخص یا شرکت</th>
            <th class="text-center"><i class="fa fa-mobile"></i> شماره تماس</th>
            <th class="text-center"><i class="fa fa-tag"></i> زمینه فعالیت</th>
            <th><i class="fa fa-file-text"></i> توضیحات</th>
            <th class="text-center"><i class="fa fa-star"></i> اهمیت </th>
            <th>وضعیت</th>
            <th>به یاد آوری در</th>
        </tr>
        </thead>
        <tbody>
       @foreach($leads as $lead)
          <tr class="inline-form-tr">
              <td>#{{$lead->id}}</td>
              <td>{{$lead->name}}</td>
              <td class="text-center" style="direction: ltr">{{$lead->phones->first()->number}}</td>
              <td class="text-center" style="direction: ltr">{{$lead->tags->first()->name}}</td>
              <td>{{empty($lead->description) ? 'ندارد' : softTrim($lead->description,50)}}</td>
              <td class="text-center">
                  @for($i=1;$i<=$lead->priority + 1;$i++)
                      <i style="color:#CC9900" class="fa fa-star"></i>
                  @endfor
              </td>
              <td>
                  <span class="label label-<?php print statusClass($lead->status)?>">
                      {{$opiloConfig['lead_status'][$lead->status]}}
                  </span>
              </td>
              <td>
                  @if(!is_null($lead->remind_at))
                      <i class="fa fa-calendar"></i> {{$lead->jalaliDate('remind_at')}} ({{$lead->jalaliAgoDate('remind_at')}})
                  @else
                    <code>ندارد</code>
                  @endif
              </td>
          </tr>
      @endforeach
    </table>

    <div class="row">
    	{{$leads->appends(Input::except('page'))->links()}}
    </div>

@stop

@section('footer')
    @include('admin.blocks.delete_modal')
    @include('admin.blocks.update_modal')
    @parent
@stop