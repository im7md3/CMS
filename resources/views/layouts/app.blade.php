<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
        a{text-decoration: none !important}
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                @include('partials.navbar')
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="text-right">
                    @include('alerts.success')
                    @include('alerts.fails')
                </div>
                <div class="row text-right">

                    @yield('content')
                </div>
            </div>
        </main>

        <footer class="bg-dark text-center p-4">
            <a href="{{url('/')}}" class="d-flex flex-column ">
                <i class="text-white fas fa-users-cog fa-3x mb-1"></i>
                <h3 class="text-white">CMS</h3>
            </a>

        </footer>
    </div>
    <script src="{{ asset('/js/app.js') }}"></script>
    @yield('script')
</body>

</html>
