@extends('layouts.app')

@section('content')

<h2 class="text-center">All Products</h2>

<div class="my-4">
<form action="{{ route('products.search_products') }}" method="GET" role="search">
      {{ csrf_field() }}
      <div class="input-group">
          <input type="text" class="form-control" name="query" placeholder="Search Itens">
            <button type="submit" class="btn btn-primary">Search</button>
            </span>
          </div>
    </form>
</div>

<ul class="list-group py-3 mb-3">
    @forelse($products as $product)
    <li class="list-group-item my-2">
        <a href="{{route('products.show',$product->id)}}">
            <h5>Name: {{$product->nome}}</h5><br>
            <h5>Category: {{$product->categoria}}</h5><br>
            <p>Price: {{$product->preco}}&euro;</p>
            <small class="float-right">{{$product->created_at->diffForHumans()}}</small>
        </a>
    </li>
    @empty
    <h4 class="text-center">No Products Found!</h4>
    @endforelse
</ul>
<div class="d-flex justify-content-center">
    {{$products->links()}}
</div>

@endsection
