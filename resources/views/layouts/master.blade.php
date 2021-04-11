<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   @include('layouts.includes.head')
</head>
<header>
    @include('layouts.includes.navbar')
</header>
<body>
    <div id="main">
        <main class="row">
            @yield('content')
        </main>
    </div>
</body>
@unless(Request::is('userinfo'))
<div class="spacer"></div>
@endunless
<footer>
    <div class="row footer">
        @include('layouts.includes.footer')
    </div>
</footer>
</html>
