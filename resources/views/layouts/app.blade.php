<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<script src="{{ asset('js/qr_code_creator.js') }}"></script>
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
