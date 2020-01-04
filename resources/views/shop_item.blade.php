@extends('layouts.app_homepage')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Item</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/homepage.css')}}"> {{-- <- your css --}}

        <!-- Bootstrap core CSS -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    </head>
    <body>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <a href="/"><h1 class="my-4">Shop Tech</h1></a>
        <div class="list-group">
            <a href="{{route('welcome.products_category',$category='Laptop')}}" class="list-group-item">Laptop</a>
            <a href="{{route('welcome.products_category',$category='Desktop')}}" class="list-group-item">Desktop</a>
            <a href="{{route('welcome.products_category',$category='Tablets')}}" class="list-group-item">Tablets</a>
            <a href="{{route('welcome.products_category',$category='Smartphones')}}" class="list-group-item">Smartphones</a>
            <a href="{{route('welcome.products_category',$category='Smartwatches')}}" class="list-group-item">Smartwatches</a>
            <a href="{{route('welcome.products_category',$category='Monitores')}}" class="list-group-item">Monitores</a>
        </div>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div class="card mt-4">
          <img class="card-img-top img-fluid" src="http://placehold.it/900x400" alt="">
          <div class="card-body">
            <h3 class="card-title">{{$product->nome}}</h3>
            <h4>{{$product->preco}}&euro;</h4>
            <p class="card-text">{{$product->descricao}}</p>
            <a href="/">Voltar</a>
          </div>
        </div>

    </div>
</div>
</body>
</html>
@endsection
