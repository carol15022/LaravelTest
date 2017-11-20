<!DOCTYPE html>

<html>
    <head>
        <title>{{$title or 'Painel de Produtos'}}</title>

        <!--Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset("css/style.css")}}">
    </head>

    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>