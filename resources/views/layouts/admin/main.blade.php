<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{url('/css/app.css')}}">
    <link rel="stylesheet" href="{{url('/css/custom.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="icon" type="image/x-icon" href="/core-images/logo-small.png">
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL'0,
                'wght'400,
                'GRAD'0,
                'opsz'48
        }
    </style>

    <title>Setanam</title>
</head>

<body class="font-default">
    @include("layouts.admin.navbar")
    <div class="py-2">
        <div class="flex justify-center">
            <div class=" max-w-[1440px] w-full ">
                @yield("head")
            </div>
        </div>
    </div>

    <main class="mb-[40px] py-[24px] md:py-[40px] lg:py-[80px]">
        <div class="flex justify-center">
            <div class=" max-w-[1440px] w-full ">

                @yield("content")
            </div>
        </div>
    </main>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @yield("script")
</body>

</html>