<html>

<head>
    <title>Olá Mundo @@yield('title')</title>
    {{Html::style('css/bootstrap.min.css')}}
    {{Html::style('css/bootstrap-utilities.min.css')}}
    {{Html::style('css/bootstrap-grid.min.css')}}
</head>

<body>
    <div class="container">
        @yield('content')
    </div>

    {{Html::script('js/jquery-3.6.0.min.js')}}
    {{Html::script('js/bootstrap.min.js')}}
</body>

</html>

