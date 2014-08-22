<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-list"></i>لیست لیدهای دارای تاریخ به یادآوری</h3>
	</div>
	<div class="panel-body">
	    @if(! $remindingLeads->isEmpty())
        <div class="table-responsive">
            <table class="table table-hover table-stripped my-lead-table">
                <thead>
                <tr>
                    <th><i class="fa fa-flag"></i> شناسه</th>
                    <th><i class="fa fa-user"></i> نام شخص یا شرکت</th>
                    <th><i class="fa fa-mobile"></i> شماره تماس</th>
                    <th><i class="fa fa-file-text"></i> وضعیت رسیدگی</th>
                    <th>وضعیت</th>
                    <th>به یاد آوری در</th>
                    <th class="languageLeft">عملیات</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($remindingLeads as $lead)
                        <tr>
                            <td>{{$lead->id}}</td>
                            <td>{{$lead->name}}</td>
                            <td>{{$lead->phones->first()->number}}</td>
				            <td class="priorities" style="display: none;">{{Form::select( 'priority',array(0,1,2,3,4,5),0,['class' => 'form-control languageLeft bulkable resettable'])}}</td>
				            <td class="statuses" style="display: none"> {{Form::select('status',$opiloConfig['lead_status'],0,['class' => 'form-control stable'])}}</td>
                            <td class="text-center">
                                @if($lead->remind_at >  $lead->updated_at)
                                    <span class="fa fa-times"></span>
                                @else
                                    <span class="fa fa-check"></span> {{$lead->jalaliAgoDate('updated_at')}}
                                @endif
                            </td>
                            <td>
                                <span class="label label-<?php print statusClass($lead->status)?>">
                                    {{$opiloConfig['lead_status'][$lead->status]}}
                                </span>
                            </td>
                            <td>
                                @if(!is_null($lead->remind_at))
                                    <i class="fa fa-calendar"></i> {{$lead->jalaliDate('remind_at')}}
                                @else
                                    <code>ندارد</code>
                                @endif
                            </td>
                            <td class="languageLeft">
                                @include('admin.pages.lead.partials._my_list_operation')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p class="text-center"><code>موردی وجود ندارد</code></p>
        @endif
    </div>
</div>
