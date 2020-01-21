@extends('layouts.app')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
    </div>

    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
        </div>
        @endif

<div class="my-4">
<form action="{{ route('products.search_products') }}" method="GET" role="search">
      @csrf
      <div class="input-group">
          <input type="text" class="form-control" name="query" placeholder="Search Itens">
            <button type="submit" class="btn btn-primary">Search</button>
            </span>
          </div>
    </form>
</div>


<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Image</th>
          <th>Description</th>
          <th>Stock</th>
          <th>Created at</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $product)
        <tr>
            <td><img height="200px" width="200px" class="rounded mx-auto d-block" src="{{asset('img/products/'.$product->imagem)}}" alt=""></td>
            <td><strong>Name:</strong> {{$product->nome}}<br><strong>Category:</strong> {{$product->categoria}}<br><strong>Price:</strong> {{$product->preco}}&euro;</td>
            <td>{{$product->stock}}</td>
            <td>{{$product->created_at->diffForHumans()}}</td>
            <td><a href="{{route('products.show',$product->id)}}">Show details</a></td>
        </tr>
        @empty
            <h4 class="text-center">No Products Found!</h4>
        @endforelse
      </tbody>
    </table>
  </div>

<div class="d-flex justify-content-center">
    {{$products->links()}}
</div>

</div>
</div>

@endsection
