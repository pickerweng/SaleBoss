@if(empty($menu['children']))
    <li class="{{!empty($menu['active']) ? 'active' : ''}}"><a href="{{URL::to($menu['uri'])}}">{{$menu['title']}}</a></li>
@else
    <li class="{{!empty($menu['active']) ? 'active' : ''}} hover">
        <a href="#">{{$menu['title']}}<b class="arrow fa fa-angle-left"></b></a>
        <b class="arrow"></b>
        <ul class="submenu">
            @foreach($menu['children'] as $child)
                {{View::make('admin.blocks.menu_dropdown',['menu' => $child])->render()}}
            @endforeach
        </ul>
    </li>
@endif