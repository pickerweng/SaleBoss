<!DOCTYPE html>
<html lang="en">
	<head>
        @section('head_tag')
            @include('admin.blocks.head_tag')
        @show
  </head>
<body class="no-skin rtl">
    @section('navbar')
        @include('admin.sections.navbar.main')
    @show

    <div class="main-container" id="main-container">
     <div class="sidebar responsive" id="sidebar">
          @include('admin.sections.navigation.sidebar')
     </div>

     <div class="main-content">
      <div class="breadcrumbs">
           @include('admin.sections.content.header--breadcrumb')
      </div>
            @include('admin.blocks.messages')

      <div class="page-content" id="page-wrapper">
        <div class="row">
          <div class="col-xs-12">
           @yield('content')
          </div><!-- /.col -->
        </div><!-- /.row -->

      </div><!-- /.page-content -->
     </div><!-- /.main-content -->

     <!-- footer area -->

   </div><!-- /.main-container -->

@yield('footer')
@show
@section('footer')
    @include('admin.sections.content.footer')
@show
 </body>
 </html>
