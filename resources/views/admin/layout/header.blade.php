<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=7">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />


      <link rel="icon" href="{{ url('assets/images/favicon.ico') }}" type="image/x-icon">

      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="{{ url('assets/css/bootstrap/css/bootstrap.min.css') }}">

      <link rel="stylesheet" type="text/css" href="{{ url('assets/icon/themify-icons/themify-icons.css') }}">
	  <link rel="stylesheet" type="text/css" href="{{ url('assets/icon/font-awesome/css/font-awesome.min.css') }}">

      <link rel="stylesheet" type="text/css" href="{{ url('assets/icon/icofont/css/icofont.css') }}">
      <meta content="authenticity_token" name="{{ csrf_token() }}" />
      <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url('assets/css/ripple-effect.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url('assets/css/jquery.mCustomScrollbar.css') }}">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
      @yield('css')
      @yield('link')
      <style>
        /* loader csss */
.loader {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: inline-block;
  position: relative;
  border: 3px solid;
  border-color: #FFF #FFF transparent transparent;
  box-sizing: border-box;
  animation: rotation 1s linear infinite;
}
.loader::after,
.loader::before {
  content: '';
  box-sizing: border-box;
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  margin: auto;
  border: 3px solid;
  border-color: transparent transparent #FF3D00 #FF3D00;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  box-sizing: border-box;
  animation: rotationBack 0.5s linear infinite;
  transform-origin: center center;
}
.loader::before {
  width: 32px;
  height: 32px;
  border-color: #FFF #FFF transparent transparent;
  animation: rotation 1.5s linear infinite;
}

@keyframes rotation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
@keyframes rotationBack {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(-360deg);
  }
}

/*loader css */

#loader-box{
    position: fixed;
    width: 100%;
    height: 100%;
    left: 0;;
    background:rgba(0,0,0,0.5);
z-index: 999999999;;

}
#loader-box div{
    position: absolute;
    top:50%;
    left: 50%;
    transform: translate(-50%,-50%);
}
.d-none{
    display: none;
}
      </style>
  </head>

  <body>
  <body>
    <div class="loader-box" id="loader-box">
        <div>
            <span class="loader"></span>

        </div>
      </div>

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

<script src="{{ url('assets/js/ripple-effect.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('alert.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
{{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet"> --}}
<style>
    .p-font{
        font-family: 'Poppins', sans-serif;
        font-weight: 900;
        font-weight: bolder;
    }
</style>
@yield("css")
<script src="{{ url('alert.js') }}"></script>
@yield('script')

<script>
    $(document).ready(function(){
        $(function(){
  $('button, a, li,div').rippleEffect();
});
    });
</script>
@yield("custom-js")
</body>

</html>
