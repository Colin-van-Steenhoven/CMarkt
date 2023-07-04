<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>C-Market!</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicons/favicon-32x32.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('.select2-tags').select2({
                tags: true,
                tokenSeparators: [',', ' '], 
                closeOnSelect: false, 
            });
        });
    </script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <header>
            @include('components.header')
        </header>
        <div class="container">
            <main class="py-4 footer-fix">
                @yield('content')
            </main>
            <footer>
                @include('components.footer')
            </footer>
        </div>
    </div>
</body>
</html>
