@extends('layouts.app')

@section('content')

<div class="rounded mx-auto d-block">
    <a class="btn btn-primary" href="{{ url()->previous() }}">Voltar</a>
    <div class="card mt-4">
      <img id="img_show" class="card-img-top img-fluid" src="{{asset('img/products/'.$product->imagem)}}" alt="">
      <div class="card-body">
        <h3 class="card-title">{{$product->nome}}</h3>
        <h4>{{$product->preco}}&euro;</h4>
        <p class="card-text">{!!$product->descricao!!}</p>

        @if($product->stock > 0)
            <p style="color:green"><strong>Stock</strong>: Available &#9989;</p>
          @else
            <p style="color:red"><strong>Stock</strong>: Unavailable &#10060;</p>
          @endif

          <a href="{{route('products.edit',$product->id)}}" class="btn btn-primary float-left">Update</a>
          <a href="#" class="btn btn-danger float-right" data-toggle="modal" data-target="#delete-modal">Delete</a>

      </div>
    </div>
</div>

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
