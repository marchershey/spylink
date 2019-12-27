<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SpyLink is a Link/URL Shortening Service with a catch.">
    <meta name="author" content="Marc Hershey and the GitHub Community">
    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column h-100">
    <main role="main" class="flex-shrink-0">

        @include('layouts.index.header')

        @yield('content')

    </main>

    @include('layouts.index.footer')

</body>

</html>
