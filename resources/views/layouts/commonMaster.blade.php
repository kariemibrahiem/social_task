<!DOCTYPE html>

<html
        class="light-style layout-menu-fixed"
        lang="{{ app()->getLocale() }}"
        dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
        data-theme="theme-default"
        data-assets-path="{{ asset('/assets') . '/' }}"
        data-base-url="{{ url('/') }}"
        data-framework="laravel"
        data-template="vertical-menu-laravel-template-free"
`
>

<head>

  <style>
    body {
      font-family: 'Cairo', sans-serif;
      overflow-x: hidden !important;
    }
  </style>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title') {{ trns("news") }} </title>
  <meta name="description" content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
  <meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
  
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/kaiadmin/icon.png') }}" />
    
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/css/demo-rtl.css') }}">
    @endif

  @include('layouts/sections/styles')

  @include('layouts/sections/scriptsIncludes')
</head>
@stack('scripts') 

<body>
  
  @yield('layoutContent')
  
  @include('layouts/sections/scripts')

  @push('scripts')

<script src="https://js.pusher.com/8.2/pusher.min.js"></script>
<script>
    // Enable pusher logging - remove in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
      cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
      encrypted: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      toastr.info(data.message);
      console.log(data);
    });
</script>
@endpush

</body>

</html>
