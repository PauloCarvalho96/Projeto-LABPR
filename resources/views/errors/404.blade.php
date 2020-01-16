<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}"> {{-- <- your css --}}
    <title>@yield('title','Homepage')</title>

     <!-- Fonts -->
     <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

     <!-- Styles -->
     <link rel="stylesheet" href="{{asset('css/homepage.css')}}"> {{-- <- your css --}}

     <!-- Bootstrap core CSS -->
     <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

     <link href="{{asset('css/404.css')}}" rel="stylesheet">

</head>
<body>




    <link rel="stylesheet" href="{{asset('css/navbar.css')}}"> {{-- <- your css --}}

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Homepage</a>
        </div>
    </nav>

<p class="center">Space Invadors destroyed this page! Take revenge on them!
    <br/> Use <span class="label label-danger">Space</span> to shoot and <span class="label label-danger">←</span>&#160;<span class="label label-danger">→</span> to move!&#160;&#160;&#160;<button class="btn btn-default btn-xs" id="restart">Restart</button></p>

  <canvas id="space-invaders">

</body>
</html>

<script src="{{asset('js/404.js')}}"></script>
