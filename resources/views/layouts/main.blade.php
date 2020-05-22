<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        @include('../partials.head')
    </head>
    <body>
        @include('../partials.nav')

        <br><br>
        <br><br><br>

        @yield('content')

        @include('../partials.footer')
    </body>
</html>