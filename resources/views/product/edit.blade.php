@extends('layouts.app')
@section('content')
    <h3 class="text-center">Edit product</h3>
    <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="exampleFormControlFile1">Image</label>
            <input type="file" name="imagem" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="nome" id="title" class="form-control" value="{{ old('nome') ? : $product->nome }}" placeholder="Enter the name">
        </div>
        <div class="form-group">
            <label for="category"></label>
                <select name="categoria" class="form-control" id="title">
                    <option value="categoria" disabled selected>{{ old('nome') ? : $product->categoria }}</option>
                    <option name="categoria">Laptop</option>
                    <option name="categoria">Desktop</option>
                    <option name="categoria">Tablets</option>
                    <option name="categoria">Smartphones</option>
                    <option name="categoria">Smartwatches</option>
                    <option name="categoria">Monitores</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="descricao">{{old('descricao') ? : $product->descricao }}</textarea>
                    <script>
                            CKEDITOR.replace('descricao');
                    </script>
            </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="preco" id="title" class="form-control" value="{{old('preco') ? : $product->preco }}" placeholder="Enter the price">
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" min="0" name="stock" id="title" class="form-control" value="{{old('stock') ? : $product->stock}}" placeholder="Enter the stock" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection
