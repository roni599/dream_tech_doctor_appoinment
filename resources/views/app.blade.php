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
    <link rel="stylesheet" href="{{ asset('hospital/backend/app/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('hospital/backend/app/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('hospital/backend/app/assets/bundles/prism/prism.css') }}">

    <link rel="stylesheet" href="{{ asset('hospital/backend/app/assets/bundles/ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('hospital/backend/app/assets/bundles/weather-icon/css/weather-icons.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('hospital/backend/app/assets/bundles/weather-icon/css/weather-icons-wind.min.css') }}">

    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('hospital/backend/app/assets/img/heartboard-1.png') }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="antialiased">
    <div id="app"></div>
    @vite('resources/js/app.js')
    <script src="{{ asset('hospital/backend/app/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('hospital/backend/app/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('hospital/backend/app/assets/js/custom.js') }}"></script>
    <script src="{{ asset('hospital/backend/app/assets/js/page/ion-icons.js') }}"></script>

    {{-- <script src="{{ asset('hospital/backend/app/assets/js/page/index.js') }}"></script> --}}
    {{-- <script src="{{ asset('hospital/backend/app/assets/bundles/prism/prism.js') }}"></script>
    <script src="{{ asset('hospital/backend/app/assets/bundles/apexcharts/apexcharts.min.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

</body>

</html>
