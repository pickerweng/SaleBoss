@if(empty($menu['children']))
    <li><a href="{{URL::to($menu['uri'])}}">{{$menu['title']}}</a></li>
@else
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{$menu['title']}}<b class="caret"></b></a>
        <ul class="dropdown-menu">
            @foreach($menu['children'] as $child)
                {{View::make('admin.blocks.menu_dropdown',['menu' => $child])->render()}}
            @endforeach
        </ul>
    </li>
@endif