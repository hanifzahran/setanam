<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen font-default ">

    <div class="p-40">
        <h1 class="h1">TYPOGRAPHY</h1>


        <h1 class="h1">HEADING 1</h1>
        <h1 class="h2">HEADING 2</h1>
        <h1 class="h3">HEADING 3</h1>
        <h1 class="h4">HEADING 4</h1>
        <h1 class="h5">HEADING 5</h1>
        <h1 class="h6">HEADING 6</h1>

        <br>

        <p class="font-bold font-lg">Large Text Bold</p>
        <p class="font-lg">Large Text Regular</p>
        <br>
        <p class="font-bold font-md">Medium Text Bold</p>
        <p class="font-md">Medium Text Regular</p>
        <br>
        <br>
        <p class="font-bold font-default">Normal Text Bold (font-default)</p>
        <p class="font-default">Normal Text Regular (font-default)</p>
        <p class="">Normal Text Regular (font-default)</p>
        <br>
        <br>
        <p class="font-bold font-sm">Small Text Bold (font-sm)</p>
        <p class="font-sm">Small Text Regular (font-sm)</p>
        <br>
        <p class="font-bold">Default no class bold</p>
        <p>Default no class</p>
        <br>
    </div>
</body>

</html>