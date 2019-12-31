@extends('layouts.app')
@section('content')
    <h3 class="text-center">Edit product</h3>
    <form action="{{route('products.update',$product->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Name:</label>
            <input type="text" name="nome" id="title" class="form-control" value="{{ old('nome') ? : $product->nome }}" placeholder="Enter the name">
        </div>
        <div class="form-group">
            <label for="lastName">Category:</label>
            <input type="text" name="categoria" id="title" class="form-control" value="{{ old('categoria') ? : $product->nome }}" placeholder="Enter the category">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
