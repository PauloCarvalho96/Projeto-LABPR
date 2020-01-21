@extends('layouts.app_homepage')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/homepage.css')}}"> {{-- <- your css --}}

        <!-- Bootstrap core CSS -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    </head>
    <body id="page-top">

    <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <a href="{{route('welcome')}}"><img class="img-thumbnail" src="{{asset('img/logo.png')}}" alt=""></a>
            <div class="list-group">
                <a href="{{route('welcome.products_category',$category='Laptop')}}" class="list-group-item list-group-item-action list-group-item-dark">Laptop</a>
                <a href="{{route('welcome.products_category',$category='Desktop')}}" class="list-group-item list-group-item-action list-group-item-dark">Desktop</a>
                <a href="{{route('welcome.products_category',$category='Tablets')}}" class="list-group-item list-group-item-action list-group-item-dark">Tablets</a>
                <a href="{{route('welcome.products_category',$category='Smartphones')}}" class="list-group-item list-group-item-action list-group-item-dark">Smartphones</a>
                <a href="{{route('welcome.products_category',$category='Smartwatches')}}" class="list-group-item list-group-item-action list-group-item-dark">Smartwatches</a>
                <a href="{{route('welcome.products_category',$category='Monitores')}}" class="list-group-item list-group-item-action list-group-item-dark">Monitores</a>
            </div>

            <div class="my-4">
                <form action="{{route('welcome.search')}}" method="GET" role="search">
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

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="{{asset('img/banner/banner1.png')}}" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="{{asset('img/banner/banner2.png')}}" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="{{asset('img/banner/banner3.png')}}" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <a href="{{route('welcome.sort_by_price_ascending')}}">Price &#8593;</a>
        <a href="{{route('welcome.sort_by_price_descending')}}">Price &#8595;</a>

        <div class="row">
        @forelse($products as $product)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="{{route('welcome.shop_item',$product->id)}}"><img class="card-img-top" src="{{asset('img/products/'.$product->imagem)}}" alt="">
              <div class="card-body">
              <h4 class="card-title">
                <h5>{{$product->nome}}</h5><br>
                  </a>
                <h5>Category: {{$product->categoria}}</h5><br>
              </h4>
              <h5><p>Price: {{$product->preco}}&euro;</p></h5>
              </div>

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

            </div>
          </div>
          @empty
            <h4 class="text-center">No Products Found!</h4>
          @endforelse

        </div>
        <!-- /.row -->

        <div class="d-flex justify-content-center">
            {{$products->links()}}
        </div>

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

    </body>
</html>

@endsection

