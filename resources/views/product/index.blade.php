@extends('layouts.app')

@section('content')
<h2 class="text-center">All Products</h2>
<ul class="list-group py-3 mb-3">
    @forelse($products as $product)
    <li class="list-group-item my-2">
        <a href="{{route('products.show',$product->id)}}">
            <h5>{{$product->nome}} {{$product->categoria}}</h5>
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
