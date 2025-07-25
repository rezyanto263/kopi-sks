<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('storage/images/logo.jpg') }}" type="image/jpeg">
    <title>@yield('title')</title>

    @vite('resources/css/app.css')

    @stack('styles')
</head>

<body>
    @yield('content')

    @vite('resources/js/app.js')

    @stack('scripts')
</body>

</html>
