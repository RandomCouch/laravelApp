<html>
    <head>
        <title>Laravel Demo - @yield('title')</title>
        @section('header')
        
        @show
    </head>
    <body>
        @section('menu')
        
        @show
        <div class="container">
            @yield('content')
        </div>
        
    </body>
</html>