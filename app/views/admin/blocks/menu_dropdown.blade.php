@if(empty($menu['children']))
    <li class="{{!empty($menu['active']) ? 'active' : ''}}"><a href="{{URL::to($menu['uri'])}}" class="{{!empty($menu['active']) ? 'active' : ''}}">{{$menu['title']}}</a></li>
@else
    <li class="dropdown {{!empty($menu['active']) ? 'open active' : ''}}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{$menu['title']}}<b class="caret"></b></a>
        <ul class="dropdown-menu">
            @foreach($menu['children'] as $child)
                {{View::make('admin.blocks.menu_dropdown',['menu' => $child])->render()}}
            @endforeach
        </ul>
    </li>
@endif