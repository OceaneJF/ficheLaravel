<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>
<nav>
    <a href="{{route('product.index')}}">Les produits</a>
    @guest
        <a href="{{route('login')}}">Connexion</a>
        <a href="{{route('register')}}">S'inscrire</a>
    @endguest
    @auth
        {{Auth::user()->name}}
        <form action="{{route('logout')}}" method="post">
            @method("delete")
            @csrf
            <button>Se deconnecter</button>
        </form>
        <a href="{{route('product.myProduct')}}">Mes produits</a>
    @endauth

</nav>
@yield('content')
</body>
</html>
