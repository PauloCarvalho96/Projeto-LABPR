@extends('layouts.app')
@section('content')
    <h3 class="text-center">Create a Product</h3>
    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        @csrf {{-- <- Required for protection or the form is rejected --}}
            <div class="form-group">
              <label for="exampleFormControlFile1">Image</label>
              <input type="file" name="imagem" class="form-control-file" id="exampleFormControlFile1">
            </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="nome" id="title" class="form-control" placeholder="Enter the name" required>
        </div>
        <div class="form-group">
            <label for="category"></label>
                <select name="categoria" class="form-control" id="title" required>
                    <option value="" disabled selected>Category</option>
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
            <textarea name="descricao"></textarea>
                <script>
                        CKEDITOR.replace('descricao');
                </script>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="preco" id="title" class="form-control" value="{{old('preco')}}" placeholder="Enter the price" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
