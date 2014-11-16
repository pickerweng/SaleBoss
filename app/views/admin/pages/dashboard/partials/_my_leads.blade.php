<div style="margin-bottom: 10px;">
          <div class="table-header Nassim Nassim700 NassimTitle panelColor" style="padding-right: 10px;" >
                <i class="fa fa-list"></i> لیست لیدهای دارای تاریخ به یادآوری
          </div>
              @if(! $remindingLeads->isEmpty())
              <div>
                <div class="form-inline no-footer">
                    <table class="table table-striped table-bordered table-hover tableFontSize12 no-footer">
                           <thead>
                               <tr role="row">
                                   <th rowspan="1" colspan="1" style="padding: 13px"><i class="fa fa-flag"></i> شناسه</th>
                                   <th rowspan="1" colspan="1"><i class="fa fa-user"></i> نام شخص یا شرکت</th>
                                   <th rowspan="1" colspan="1"><i class="fa fa-mobile"></i> شماره تماس</th>
                                   <th rowspan="1" colspan="1">وضعیت</th>
                                   <th rowspan="1" colspan="1">به یاد آوری در</th>
                                   <th class="languageLeft" rowspan="1" colspan="1">عملیات</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach($remindingLeads as $lead)
                                   <tr>
                                       <td>{{$lead->id}}</td>
                                       <td>{{$lead->name}}</td>
                                       <td>{{$lead->phones->first()->number}}</td>
                                    <td class="priorities" style="display: none;">{{Form::select( 'priority',['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'], 1,['class' => 'form-control languageLeft bulkable resettable'])}}</td>
                                    <td class="statuses" style="display: none"> {{Form::select('status',$opiloConfig['lead_status'],0,['class' => 'form-control stable'])}}</td>
                                       <td>
                                           <span class="label arrowed label-<?php print statusClass($lead->status)?>">
                                               {{$opiloConfig['lead_status'][$lead->status]}}
                                           </span>
                                       </td>
                                       <td>
                                           @if(!is_null($lead->remind_at))
                                               <i class="fa fa-calendar"></i> {{$lead->jalaliDate('remind_at')}}
                                           @else
                                               ندارد
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
              </div>
          @else
              <p class="text-center">موردی وجود ندارد</p>
          @endif

</div>