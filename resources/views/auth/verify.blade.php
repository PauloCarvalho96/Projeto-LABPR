@extends('layouts.app_homepage')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="row">

            <div class="col-lg-3">

              <a href="/"><img class="img-thumbnail" src="{{asset('img/logo.png')}}" alt=""></a>
                  <div class="list-group">
                      <a href="{{route('welcome.products_category',$category='Laptop')}}" class="list-group-item list-group-item-action list-group-item-dark">Laptop</a>
                      <a href="{{route('welcome.products_category',$category='Desktop')}}" class="list-group-item list-group-item-action list-group-item-dark">Desktop</a>
                      <a href="{{route('welcome.products_category',$category='Tablets')}}" class="list-group-item list-group-item-action list-group-item-dark">Tablets</a>
                      <a href="{{route('welcome.products_category',$category='Smartphones')}}" class="list-group-item list-group-item-action list-group-item-dark">Smartphones</a>
                      <a href="{{route('welcome.products_category',$category='Smartwatches')}}" class="list-group-item list-group-item-action list-group-item-dark">Smartwatches</a>
                      <a href="{{route('welcome.products_category',$category='Monitores')}}" class="list-group-item list-group-item-action list-group-item-dark">Monitores</a>
                  </div>

                  <div class="my-4">
                      <form action="/search" method="POST" role="search">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" placeholder="Search Itens">
                              <button type="submit" class="btn btn-primary">Search</button>
                              </span>
                            </div>
                      </form>
                  </div>

            </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
