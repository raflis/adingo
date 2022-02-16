<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adingo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css?v='.time()) }}" rel="stylesheet">
    <!--<link href="{{ asset('css/aos.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <!--<link href="{{ asset('css/all.css') }}" rel="stylesheet">-->
    <script src="https://kit.fontawesome.com/084224f6ac.js" crossorigin="anonymous"></script>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    @livewireStyles
    @livewireScripts
</head>
<body>
    <div class="loading">
      <div id="loader" class="center-all"></div>
    </div>
    @yield('content')
    <script src="{{ asset('js/main.js?v='.time()) }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!--<script src="{{ asset('js/all.js') }}"></script>-->
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    @yield('script')
</body>
</html>