<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Lulu</title>
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        @include('layouts.head')
  </head>
    <body class="pb-0">
        @yield('content')
        @include('layouts.footer-script')    
        {{-- <script src="{{ URL::asset('js/app/geral.js') }}"></script> --}}
    </body>
</html>