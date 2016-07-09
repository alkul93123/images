<!DOCTYPE html>
<html ng-app='App'>
  <head>
    <meta charset="utf-8">

    <title>App Name - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" media="screen" title="no title" charset="utf-8">

    <!-- Jquery -->
    <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>

    <script>
      $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
      });
    </script>

    <!-- Angular -->
    <script src="https://code.angularjs.org/1.5.5/angular.min.js" charset="utf-8"></script>
    <script src="https://code.angularjs.org/1.5.5/angular-route.min.js" charset="utf-8"></script>
    <script src="{{ asset('js/oi.file.js') }}" charset="utf-8"></script>


    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')


  </head>
  <body>
    @yield('content')
  </body>
</html>
