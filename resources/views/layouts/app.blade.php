<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/css/adminlte.min.css">

</head>
<body>

    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section>
    <!-- /.Main content -->

</body>
</html>
