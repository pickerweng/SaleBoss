@if($lead->locker_id == $currentUser->id)
    <a href="#" disabled="true" class="btn operation-margin btn-xs pull-left btn-success"><i class="fa fa-check"></i></a>
    {{Form::open([
        'method'    =>  'delete',
        'url'       =>  'leads/locker/' . $lead->id
    ])}}
        <button type="submit" class="btn operation-margin btn-xs pull-left btn-warning">آزاد کن</button>
    {{Form::close()}}
    <a href="{{URL::to('leads/locker/' . $lead->id )}}" class="btn operation-margin btn-xs pull-left btn-info">بروز رسانی</a>
@else
    @if (ThrottleL::allows($lead))
        {{Form::open([
            'method'    =>  'put',
            'url'       =>  'leads/take/' . $lead->id
        ])}}
            <button type="submit" href="{{URL::to('leads/take/{id}')}}" class="btn operation-margin btn-xs pull-left btn-success">بگیرش <i class="fa fa-check"></i></button>
        {{Form::close()}}
    @else
        <a href="#" disabled="true" class="btn operation-margin btn-xs pull-left btn-danger"><i class="fa fa-exclamation-triangle"></i></a>
    @endif
@endif