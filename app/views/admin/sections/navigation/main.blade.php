<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">باز کردن منوی ناوبری</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        @include('admin.sections.navigation.logo')
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        @include('admin.sections.navigation.sidebar')
        @include('admin.sections.navigation.menu')
    </div>
</nav>