@extends('layouts.app')
@section('content')
    <h3 class="text-center">Create a Product</h3>
    <form action="{{route('products.store')}}" method="post">
        @csrf {{-- <- Required for protection or the form is rejected --}}
        <div class="form-group">
            <label for="title">Name:</label>
            <input type="text" name="nome" id="title" class="form-control" value="{{old('nome')}}" placeholder="Enter the name">
        </div>
        <div class="form-group">
            <label for="lastName">Category:</label>
            <input type="text" name="categoria" id="title" class="form-control" value="{{old('categoria')}}" placeholder="Enter the category">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
