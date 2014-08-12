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
            <th class="languageLeft">عملیات</th>
        </tr>
        </thead>
        <tbody>
			<tr class="inline-form-tr">
				{{Form::open([
					'url'		=>	'me/leads',
					'method'	=>	'post',
					'id'		=>	'lead-store-form'
				])}}
				<td>__</td>
				<td>{{Form::text('name',null,['class' => 'form-control bulkable', 'size' => '10'])}}</td>
				<td>{{Form::text('phone',null,['class' => 'form-control languageLeft bulkable','size' => '10'])}}</td>
				<td>{{Form::text('tag',null,['class' => 'form-control bulkable','size' => '10'])}}</td>
				<td>{{Form::text('description',null,['class' => 'form-control bulkable','size' => '10'])}}</td>
				<td>{{Form::select( 'priority',array(0,1,2,3,4,5),0,['class' => 'form-control languageLeft bulkable'])}}</td>
				<td> {{Form::select('status',$opiloConfig['lead_status'],0,['class' => 'form-control'])}}</td>
				<td>{{Form::text('remind_at',null,['class' => 'form-control', 'placeholder' => 'به یادآوری در چندروز بعد؟','size' => '10'])}}</td>
				<td>
					<button type="submit" data-loading-text="لطفا صبر کنید..." class="btn btn-success btn pull-left submit_button"><i class="fa fa-plus"></i></button>
				</td>
				{{Form::close()}}
			</tr>
            @foreach($list as $lead)
                <tr class="{{($lead->locker_id == $currentUser->id) ? 'bg-success' : ''}}">
                    <td>{{$lead->id}}</td>
                    <td class="text-center" style="direction: ltr">{{hardTrim($lead->phone_number,6)}}</td>
                    <td>{{empty($lead->description) ? 'ندارد' : softTrim($lead->description,50)}}</td>
                    <td class="text-center">
                        @for($i=1;$i<=$lead->priority + 1;$i++)
                            <i style="color:#CC9900" class="fa fa-star"></i>
                        @endfor
                    </td>
                    <td class="text-center">
                        @if (is_null($lead->locker_id))
                            <code>هیچکس</code>
                        @else
                            {{$lead->locker->getIdentifier()}}
                        @endif
                    </td>
                    <td>
                        @if( ! is_null($lead->locked_at) )
                            {{$lead->jalaliDate('locked_at')}}
                        @else
                            <code>قفل نشده</code>
                        @endif
                    </td>
                    <td>
                        <span class="label label-<?php print statusClass($lead->status)?>">
                            {{$opiloConfig['lead_status'][$lead->status]}}
                            @if( ! is_null($lead->remind_at))
                                @if(($lead->locker_id == $currentUser->id) || $currentUser->hasAnyAccess(['leads.edit']))
                                    <span class="badge">({{$lead->jalaliAgoDate('remind_at')}})</span>
                                @endif
                            @endif
                        </span>
                    </td>
                    <td class="languageLeft">
                        @include('admin.pages.lead.partials._index_operation')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>