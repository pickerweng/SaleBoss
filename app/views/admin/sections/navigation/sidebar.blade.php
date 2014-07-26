<ul class="nav navbar-nav side-nav">
	<li class="profile-sum text-center">
		<img class="profile-picture" src="{{URL::to(Sentry::getUser()->avatar())}}">
		<a class="btn btn-link" href="{{URL::to('#me')}}">پروفایل من</a>
		<a class="btn btn-link" href="{{URL::to('#me/edit')}}">ویرایش پروفایل من</a>
		<a class="btn btn-link" href="{{URL::to('#auth/logout')}}">خروج</a>
	</li>
    @foreach(MenuBuilder::fetch('sidebar') as $menu)
        {{View::make('admin.blocks.menu_dropdown',['menu' => $menu])->render()}}
    @endforeach
</ul>