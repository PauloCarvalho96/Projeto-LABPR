@extends('layouts.app')

@section('content')
    <img class="rounded mx-auto d-block" src="{{asset('img/products/'.$product->imagem)}}" alt="">
    <h5>Name: {{$product->nome}}</h5><br>
    <h5>Category: {{$product->categoria}}</h5><br>
    <h5>Description:<br>{!!$product->descricao!!}</h5><br>
    <p>Price: {{$product->preco}}&euro;</p>
    <br>
    <a href="{{route('products.edit',$product->id)}}" class="btn btn-primary float-left">Update</a>
    <a href="#" class="btn btn-danger float-right" data-toggle="modal" data-target="#delete-modal">Delete</a>
    <div class="clearfix"></div>
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="document.querySelector('#delete-form').submit()">Proceed</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        </div>
    </div>
    <form method="POST" id="delete-form" action="{{route('products.destroy',$product->id)}}">
        @csrf
        @method('DELETE')
    </form>

@endsection
