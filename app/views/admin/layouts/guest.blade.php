<!DOCTYPE html>
<html lang="fa" dir="rtl">
    <head>
        @section('head_tag')
            @include('admin.blocks.head_tag')
        @show
    </head>
    <body>
        <style>
            body {
                background: #101010;
            }
        </style>
        <div class="container">
            @yield('content')
        </div>
  </body>
</html>