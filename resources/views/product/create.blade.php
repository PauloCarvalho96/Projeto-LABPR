@extends('layouts.app')
@section('content')
    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        @csrf {{-- <- Required for protection or the form is rejected --}}

        @if (session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create a Product</h6>
            </div>

            <div class="card-body">

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
                  <input type="number" min="0" step="0.01" name="preco" id="title" class="form-control" value="{{old('preco')}}" placeholder="Enter the price" required>
              </div>

              <div class="form-group">
                  <label for="stock">Stock</label>
                  <input type="number" min="0" name="stock" id="title" class="form-control" value="{{old('stock')}}" placeholder="Enter the stock" required>
              </div>

              <button type="submit" class="btn btn-primary">Create</button>

            </div>
        </div>

    </form>
@endsection
