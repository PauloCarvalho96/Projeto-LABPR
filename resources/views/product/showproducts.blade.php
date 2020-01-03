@extends('layouts.app_client_homepage')

@section('content')
<h2 class="text-center">All Products</h2>
<ul class="list-group py-3 mb-3">
    @forelse($products as $product)
    <li class="list-group-item my-2">
        <h5>Name: {{$product->nome}}</h5><br>
        <h5>Category: {{$product->categoria}}</h5><br>
        <p>Price: {{$product->preco}}&euro;</p>
        <small class="float-right">{{$product->created_at->diffForHumans()}}</small>
    </li>
    @empty
    <h4 class="text-center">No Products Found!</h4>
    @endforelse
</ul>
<div class="d-flex justify-content-center">
    {{$products->links()}}
</div>

@endsection
