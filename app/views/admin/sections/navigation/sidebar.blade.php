<ul class="nav navbar-nav side-nav">
	<li class="profile-sum text-center">
		<img class="profile-picture" src="{{URL::to('salesboss.jpg')}}">
		<a class="btn btn-link" href="{{URL::to('me/edit')}}">{{Sentry::getUser()->getIdentifier()}}</a>
	</li>
    <li><a href="{{URL::to('dash')}}">داشبورد</a></li>
        @if(Sentry::getUser()->hasAnyAccess(['menu.admin']))
            @foreach(MenuBuilder::fetch('admin') as $menu_side)
                {{View::make('admin.blocks.menu_dropdown',['menu' => $menu_side])->render()}}
            @endforeach
        @elseif(Sentry::getUser()->hasAnyAccess(['menu.accounter']))
			@foreach(MenuBuilder::fetch('accounter') as $menu_dash)
				{{View::make('admin.blocks.menu_dropdown',['menu' => $menu_dash])->render()}}
			@endforeach
        @elseif(Sentry::getUser()->hasAnyAccess(['menu.support']))
            @foreach(MenuBuilder::fetch('support') as $menu_dash)
                {{View::make('admin.blocks.menu_dropdown',['menu' => $menu_dash])->render()}}
            @endforeach
		@elseif(Sentry::getUser()->hasAnyAccess(['menu.sales']))
            @foreach(MenuBuilder::fetch('sales') as $menu_dash)
                {{View::make('admin.blocks.menu_dropdown',['menu' => $menu_dash])->render()}}
            @endforeach
        @endif
</ul>