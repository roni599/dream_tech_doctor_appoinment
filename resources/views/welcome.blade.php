<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Doctor-app</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('hospital/backend/app/assets/css/app.min.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('hospital/backend/app/assets/bundles/bootstrap-social/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset('hospital/backend/app/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('hospital/backend/app/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('hospital/backend/app/assets/css/custom.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('hospital/backend/app/assets/img/favicon.ico') }}">
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <div id="app"></div>
    @vite('resources/js/app.js')
    <script src="{{ asset('hospital/backend/app/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('hospital/backend/app/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('hospital/backend/app/assets/js/custom.js') }}"></script>
</body>

</html>
