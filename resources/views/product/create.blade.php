@extends('layouts.app')
@section('content')
    <h3 class="text-center">Create a Product</h3>
    <form action="{{route('products.store')}}" method="post">
        @csrf {{-- <- Required for protection or the form is rejected --}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="nome" id="title" class="form-control" placeholder="Enter the name">
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" name="categoria" id="title" class="form-control"  placeholder="Enter the category">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="descricao" placeholder="Enter the description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="preco" id="title" class="form-control" value="{{old('preco')}}" placeholder="Enter the price">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
