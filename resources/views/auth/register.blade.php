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
                        @csrf
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
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last name') }}</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_number" class="col-md-4 col-form-label text-md-right">{{ __('Post number') }}</label>
                            <div class="col-md-6">
                                <input id="post_number" type="number" class="form-control" name="post_number" value="{{ old('post_number') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone number') }}</label>
                            <div class="col-md-6">
                                <input id="phone_number" type="number" class="form-control" name="phone_number" value="{{ old('phone_number') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control" name="country" value="{{ old('country') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
