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
    <link rel="icon" type="image/x-icon" href="/core-images/logo-small.png">
    <title>Setanam</title>
</head>

<body class="font-default">

<main>
    <div class="w-full min-h-screen h-full flex items-center justify-center px-[24px]">
        <div class="w-full max-w-[540px] ">
            <div class="flex justify-center">
                <img src="/core-images/logo.png" alt="">
            </div>
            <form action="/login" method="post">
                @csrf
                <div class="mt-[40px] ">
                    <h1 class="h4 font-medium md:h3  md:font-medium text-start">Isi data untuk masuk</h1>
                </div>
                <div class="mt-[40px] w-full flex-shrink-0">
                    <label for="" class="text-gray-2 text-lg">Username</label>
                    <input type="text" name="username"
                           class="rounded-[10px] border border-gray-4 text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full"/>
                </div>
                <div class="mt-[40px] w-full flex-shrink-0">
                    <label for="" class="text-gray-2 text-lg">Password</label>
                    <input type="password" name="password"
                           class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full"/>
                </div>
                <div class="mt-[40px] w-full flex-shrink-0">
                    <button type="submit"
                            class="button font-lg-responsive bg-primary  text-white rounded-[10px] py-[10px] w-full ">
                        Login
                    </button>
                </div>
            </form>
            <div class="mt-[40px] w-full flex justify-center flex-g">
                <p class="mr-[24px]">Belum Punya Akun?</p> <a href="/register" class="text-orange">Register</a>
            </div>
        </div>
    </div>
</main>

<script src="{{ mix('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>

@yield("script")
</body>

</html>
