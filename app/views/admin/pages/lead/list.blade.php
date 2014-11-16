<div class="table-responsive">
    <table class="table table-hover table-stripped">
        <thead>
        <tr>
            <th><i class="fa fa-flag"></i> شناسه</th>
            <th class="text-center"><i class="fa fa-mobile"></i> شماره تماس</th>
            <th><i class="fa fa-file-text"></i> توضیحات</th>
            <th class="text-center"><i class="fa fa-star"></i> اهمیت </th>
            <th class="text-center"><i class="fa fa-key"></i> قفل شده توسط</th>
            <th><i class="fa fa-calendar"></i> قفل شده در تاریخ</th>
            <th>وضعیت</th>
            <th class="languageLeft">عملیات</th>
        </tr>
        </thead>
        <tbody>
            @foreach($list as $lead)
                <tr class="{{($lead->locker_id == $currentUser->id) ? 'bg-success' : ''}}">
                    <td>{{$lead->id}}</td>
                    <td class="text-center" style="direction: ltr">{{hardTrim($lead->phone_number,6)}}</td>
                    <td>{{empty($lead->description) ? 'ندارد' : softTrim($lead->description,50)}}</td>
                    <td class="text-center">
                        @for($i=1;$i<=$lead->priority;$i++)
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
{{$list->links()}}