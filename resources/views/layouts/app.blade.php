<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
<header>
    @include('components.menu')
    Это приложение создает QR-код из  ссылки и формирует его в файл
</header>

<main>
    @yield('content')
</main>

<footer>
   '@assoed'
</footer>
</body>
</html>
