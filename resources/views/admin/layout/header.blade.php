<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />


      <link rel="icon" href="{{ url('assets/images/favicon.ico') }}" type="image/x-icon">

      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="{{ url('assets/css/bootstrap/css/bootstrap.min.css') }}">

      <link rel="stylesheet" type="text/css" href="{{ url('assets/icon/themify-icons/themify-icons.css') }}">
	  <link rel="stylesheet" type="text/css" href="{{ url('assets/icon/font-awesome/css/font-awesome.min.css') }}">

      <link rel="stylesheet" type="text/css" href="{{ url('assets/icon/icofont/css/icofont.css') }}">

      <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url('assets/css/jquery.mCustomScrollbar.css') }}">
      @yield('css')
      @yield('link')
  </head>

  <body>
  <body>

       <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
                @include('admin.layout.page.sidebar')

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                     @yield('content')


                                    <div id="styleSelector">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript" src="{{ url('assets/js/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/popper.js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ url('assets/js/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{ url('assets/js/modernizr/modernizr.js') }}"></script>
<!-- am chart -->
<script src="{{ url('assets/pages/widget/amchart/amcharts.min.js') }}"></script>
<script src="{{ url('assets/pages/widget/amchart/serial.min.js') }}"></script>
<!-- Chart js -->
<script type="text/javascript" src="{{ url('assets/js/chart.js/Chart.js') }}"></script>
<!-- Todo js -->
<script type="text/javascript " src="{{ url('assets/pages/todo/todo.js') }} "></script>
<!-- Custom js -->
<script type="text/javascript" src="{{ url('assets/pages/dashboard/custom-dashboard.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/script.js') }}"></script>
<script type="text/javascript " src="{{ url('assets/js/SmoothScroll.js') }}"></script>
<script src="{{ url('assets/js/pcoded.min.js') }}"></script>
<script src="{{ url('assets/js/vartical-demo.js') }}"></script>
<script src="{{ url('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
@yield('script')
</body>

</html>
