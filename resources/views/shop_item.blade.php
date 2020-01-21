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
        <a href="/"><img class="img-thumbnail" src="{{asset('img/logo.png')}}" alt=""></a>
        <div class="list-group">
            <a href="{{route('welcome.products_category',$category='Laptop')}}" class="list-group-item list-group-item-action list-group-item-dark">Laptop</a>
            <a href="{{route('welcome.products_category',$category='Desktop')}}" class="list-group-item list-group-item-action list-group-item-dark">Desktop</a>
            <a href="{{route('welcome.products_category',$category='Tablets')}}" class="list-group-item list-group-item-action list-group-item-dark">Tablets</a>
            <a href="{{route('welcome.products_category',$category='Smartphones')}}" class="list-group-item list-group-item-action list-group-item-dark">Smartphones</a>
            <a href="{{route('welcome.products_category',$category='Smartwatches')}}" class="list-group-item list-group-item-action list-group-item-dark">Smartwatches</a>
            <a href="{{route('welcome.products_category',$category='Monitores')}}" class="list-group-item list-group-item-action list-group-item-dark">Monitores</a>
        </div>
        <div class="my-4">
            <form action="/search" method="GET" role="search">
              @csrf
              <div class="input-group">
                  <input type="text" class="form-control" name="query" placeholder="Search Itens">
                    <button type="submit" class="btn btn-primary">Search</button>
                    </span>
                  </div>
            </form>
        </div>
      </div>

      <!-- /.col-lg-3 -->
      <div class="col-lg-9">
        <a class="btn btn-primary" href="{{ url()->previous() }}">Voltar</a>
        <div class="card mt-4">
          <img id="img_show" class="card-img-top img-fluid" src="{{asset('img/products/'.$product->imagem)}}" alt="">
          <div class="card-body">


            @if($product->stock > 0)
            <p style="color:green"><strong>Stock</strong>: Available &#9989;</p>
          @else
            <p style="color:red"><strong>Stock</strong>: Unavailable &#10060;</p>
          @endif

          @if($product->stock > 0)

          @auth
          @if(!auth()->user()->is_admin)
          <div class="card-footer">
              <a class="btn btn-primary" href="{{ route('product.addToCart',$product->id)}}" >Add to Cart</a>
          </div>
          @endauth
          @else
          <div class="card-footer">
              <a class="btn btn-primary" href="{{ route('product.addToCart',$product->id)}}" >Add to Cart</a>
          </div>
          @endif

        @else

          @auth
          @if(!auth()->user()->is_admin)
          <div class="card-footer">
              <button class="btn btn-secundary" disabled>Out Of Stock</button>
          </div>
          @endauth
          @else
          <div class="card-footer">
              <button class="btn btn-secundary" disabled>Out Of Stock</button>
          </div>
          @endif

        @endif

            <h3 class="card-title">{{$product->nome}}</h3>
            <h4>{{$product->preco}}&euro;</h4>
            <p class="card-text">{!!$product->descricao!!}</p>

          </div>
        </div>
    </div>
</div>
</body>
</html>
@endsection
