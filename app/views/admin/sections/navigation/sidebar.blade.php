<ul class="nav navbar-nav side-nav">
	<li class="profile-sum text-center">
		<img class="profile-picture" src="{{URL::to('salesboss.jpg')}}">
		<a class="btn btn-link" href="{{URL::to('users/' . Sentry::getUser()->id . '/edit')}}">{{Sentry::getUser()->getIdentifier()}}</a>
		<a class="btn btn-link" href="{{URL::to('users/' . Sentry::getUser()->id . '/edit')}}">ویرایش پروفایل من</a>
		<a class="btn btn-link" href="{{URL::to('auth/logout')}}">خروج</a>
	</li>
    <li><a href="{{URL::to('dash')}}">داشبورد</a></li>
        @if(Sentry::getUser()->hasAnyAccess(['menu.admin']))
            @foreach(MenuBuilder::fetch('admin') as $menu_side)
                {{View::make('admin.blocks.menu_dropdown',['menu' => $menu_side])->render()}}
            @endforeach
        @elseif(Sentry::getUser()->hasAnyAccess(['menu.sales']))
            @foreach(MenuBuilder::fetch('sales') as $menu_dash)
                {{View::make('admin.blocks.menu_dropdown',['menu' => $menu_dash])->render()}}
            @endforeach
        @endif
</ul>