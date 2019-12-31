<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Homepage</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{route('pages.index')}}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('products.index')}}" class="nav-link">Show Products</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('products.create')}}" class="nav-link">Add Products</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('pages.about')}}" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
            </ul>
        </div>
    </div>
</nav>
