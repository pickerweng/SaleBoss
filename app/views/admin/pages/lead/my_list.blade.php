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
			<tr class="inline-form-tr warning">
				{{Form::open([
					'url'		=>	'me/leads',
					'method'	=>	'post',
					'id'		=>	'lead-store-form'
				])}}
				<td>__</td>
				<td>{{Form::text('name',null,['placeholder' => 'نام شخص یا شرکت','class' => 'form-control bulkable resettable', 'size' => '10'])}}</td>
				<td>{{Form::text('phone',null,['placeholder' => 'شماره تماس','class' => 'form-control languageLeft bulkable resettable','size' => '10'])}}</td>
				<td class="tags">{{Form::select('tag',SaleBoss\Models\Tag::getTagList(),182,['class' => 'form-control stable'])}}</td>
				<td>{{Form::text('description',null,['placeholder' => 'توضیحات','class' => 'form-control bulkable resettable','size' => '10'])}}</td>
				<td class="priorities">{{Form::select( 'priority',array(0,1,2,3,4,5),0,['class' => 'form-control languageLeft bulkable resettable'])}}</td>
				<td class="statuses"> {{Form::select('status',$opiloConfig['lead_status'],0,['class' => 'form-control stable'])}}</td>
				<td>{{Form::text('remind_at',null,['class' => 'form-control resettable', 'placeholder' => 'به یادآوری در چندروز بعد؟','size' => '3'])}}</td>
				<td>
					<button type="submit" data-loading-text='<i class="fa fa-spinner"></i>' class="btn operation-margin btn-success btn pull-left submit_button"><i class="fa fa-plus"></i></button>
					<button type="reset" class="btn btn-warning pull-left"><i class="fa fa-list"></i></button>
				</td>
				{{Form::close()}}
			</tr>
            @foreach($list as $lead)
                <tr @if ($lead->new_lead === 1) style="background-color: #F4726D;" @endif>
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
                    <td class="languageLeft">
						@include('admin.pages.lead.partials._my_list_operation')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row">
	{{$list->appends(Input::except('page'))->links()}}
</div>
