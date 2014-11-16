@extends('admin.layouts.default')
     @section('title')
     	@parent | ایجاد لید جدید
     @stop
     @section('breadcrumb')
     	@parent
     	<li class="active"><a href="{{URL::to('leads')}}"><i class="fa fa-list"></i> لیدها</a></li>
         <li class="active"><i class="fa fa-plus"></i> ایجاد</li>
     @stop
     @section('content')
     <div class="row">
     	<div class="col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
             @include('admin.pages.lead.partials._form')
     	</div>
     </div>
     @stop