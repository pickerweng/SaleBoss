<!DOCTYPE html>
<html lang="fa" dir="rtl">
    <head>
        @section('head_tag')
            @include('admin.blocks.head_tag')
        @show
  </head>
  <body>
      @section('body_default')
      <div id="wrapper">
        @section('navigation')
          @include('admin.sections.navigation.main')
        @show
        <div id="page-wrapper">
          @section('content_header')
            @include('admin.sections.content.header')
          @show
          @yield('content')
        </div>
      </div>
		@yield('footer')
      @show
      @include('admin.sections.content.footer')
  </body>
</html>
