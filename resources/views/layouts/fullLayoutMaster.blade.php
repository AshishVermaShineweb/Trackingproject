@isset($pageConfigs)
  {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset

<!DOCTYPE html>
@php $configData = Helper::applClasses(); @endphp

<html class="loading {{ $configData['theme'] === 'light' ? '' : $configData['layoutTheme'] }}"
  lang="@if (session()->has('locale')){{ session()->get('locale') }}@else{{ $configData['defaultLanguage'] }}@endif" data-textdirection="{{ env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr' }}"
  @if ($configData['theme'] === 'dark') data-layout="dark-layout"@endif>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description"
    content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
  <meta name="keywords"
    content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="PIXINVENT">
  <title>@yield('title') - Vuexy - Bootstrap HTML & Laravel admin template</title>
  <link rel="apple-touch-icon" href="{{ asset('images/ico/favicon-32x32.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/favicon.ico') }}">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
    rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  {{-- Include core + vendor Styles --}}
  @include('panels/styles')

  {{-- Include core + vendor Styles --}}
  @include('panels/styles')
  <style>
    /* for sm */

.custom-switch.custom-switch-sm .custom-control-label {
    padding-left: 1rem;
    padding-bottom: 1rem;
}

.custom-switch.custom-switch-sm .custom-control-label::before {
    height: 1rem;
    width: calc(1rem + 0.75rem);
    border-radius: 2rem;
}

.custom-switch.custom-switch-sm .custom-control-label::after {
    width: calc(1rem - 4px);
    height: calc(1rem - 4px);
    border-radius: calc(1rem - (1rem / 2));
}

.custom-switch.custom-switch-sm .custom-control-input:checked ~ .custom-control-label::after {
    transform: translateX(calc(1rem - 0.25rem));
}

/* for md */

.custom-switch.custom-switch-md .custom-control-label {
    padding-left: 2rem;
    padding-bottom: 1.5rem;
}

.custom-switch.custom-switch-md .custom-control-label::before {
    height: 1.5rem;
    width: calc(2rem + 0.75rem);
    border-radius: 3rem;
}

.custom-switch.custom-switch-md .custom-control-label::after {
    width: calc(1.5rem - 4px);
    height: calc(1.5rem - 4px);
    border-radius: calc(2rem - (1.5rem / 2));
}

.custom-switch.custom-switch-md .custom-control-input:checked ~ .custom-control-label::after {
    transform: translateX(calc(1.5rem - 0.25rem));
}

/* for lg */

.custom-switch.custom-switch-lg .custom-control-label {
    padding-left: 3rem;
    padding-bottom: 2rem;
}

.custom-switch.custom-switch-lg .custom-control-label::before {
    height: 2rem;
    width: calc(3rem + 0.75rem);
    border-radius: 4rem;
}

.custom-switch.custom-switch-lg .custom-control-label::after {
    width: calc(2rem - 4px);
    height: calc(2rem - 4px);
    border-radius: calc(3rem - (2rem / 2));
}

.custom-switch.custom-switch-lg .custom-control-input:checked ~ .custom-control-label::after {
    transform: translateX(calc(2rem - 0.25rem));
}

/* for xl */

.custom-switch.custom-switch-xl .custom-control-label {
    padding-left: 4rem;
    padding-bottom: 2.5rem;
}

.custom-switch.custom-switch-xl .custom-control-label::before {
    height: 2.5rem;
    width: calc(4rem + 0.75rem);
    border-radius: 5rem;
}

.custom-switch.custom-switch-xl .custom-control-label::after {
    width: calc(2.5rem - 4px);
    height: calc(2.5rem - 4px);
    border-radius: calc(4rem - (2.5rem / 2));
}

.custom-switch.custom-switch-xl .custom-control-input:checked ~ .custom-control-label::after {
    transform: translateX(calc(2.5rem - 0.25rem));
}
  </style>
</head>



<body
  class="vertical-layout vertical-menu-modern {{ $configData['bodyClass'] }} {{ $configData['theme'] === 'dark' ? 'dark-layout' : '' }} {{ $configData['blankPageClass'] }} blank-page"
  data-menu="vertical-menu-modern" data-col="blank-page" data-framework="laravel"
  data-asset-path="{{ asset('/') }}">

  <!-- BEGIN: Content-->
  <div class="app-content content {{ $configData['pageClass'] }}">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">
      <div class="content-body">

        {{-- Include Startkit Content --}}
        @yield('content')

      </div>
    </div>
  </div>
  <!-- End: Content-->

  {{-- include default scripts --}}
  @include('panels/scripts')

  <script type="text/javascript">
    $(window).on('load', function() {
      if (feather) {
        feather.replace({
          width: 14,
          height: 14
        });
      }
    })
  </script>

</body>

</html>
