<ul class="nav navbar-nav side-nav">
    @foreach(MenuBuilder::fetch('sidebar') as $menu)
        {{View::make('admin.blocks.menu_dropdown',['menu' => $menu])->render()}}
    @endforeach
</ul>