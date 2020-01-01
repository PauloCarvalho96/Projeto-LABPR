@extends('layouts.app')
@section('content')
    <h3 class="text-center">Edit product</h3>
    <form action="{{route('products.update',$product->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="nome" id="title" class="form-control" value="{{ old('nome') ? : $product->nome }}" placeholder="Enter the name">
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" name="categoria" id="title" class="form-control" value="{{ old('categoria') ? : $product->categoria }}" placeholder="Enter the category">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="descricao" placeholder="Enter the description" class="form-control" id="exampleFormControlTextarea1" rows="3">
                {{old('descricao') ? : $product->descricao }}
            </textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="preco" id="title" class="form-control" value="{{old('preco') ? : $product->preco }}" placeholder="Enter the price">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
