<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
<header>
    @include('components.menu')
    Это приложение создает QR-код из вашей ссылки и позволяет Вам его сохранить или отправить на почту в определенном формате
</header>

<main>
    @yield('content')
</main>

<footer>
   '@assoed'
</footer>
</body>
</html>
