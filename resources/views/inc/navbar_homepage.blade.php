<div class="container">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                @if(!auth()->user()->is_admin)
                <a href="{{ route('product.shoppingCart') }}">{{ Cart::getTotalQuantity() }} Cart</a>
                @endif

                <a href="{{ route('pages.orders') }}">Bem vindo, {{Auth::user()->name}}</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div>
