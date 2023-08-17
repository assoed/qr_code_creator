<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
<header>
    @include('components.menu')

</header>

<main>
    @yield('content')
</main>

<footer>
   @assoed
</footer>
</body>
</html>
