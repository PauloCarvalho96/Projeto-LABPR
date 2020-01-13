<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}"> {{-- <- your css --}}
    <title>@yield('title','Client Page')</title>
</head>
<body>
    @include('inc.navbar_client')

    <main class="container mt-4">
    @if(Session::has('success'))
    <div class ="row">
          <div id="charge-message" class ="alert alert-success">
              {{Session::get('success')}}
          </div>
    </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Shopping Cart</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Quantity</th>
                  <th>Name</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                @if($products)
                @foreach ($products as $product)
                <tr>
                    <td><a type = "button" href="{{route('product.lessItem',$product->id)}}">-</a>{{ $product->quantity }} <a href="{{route('product.addToCart',$product->id)}}">+</a></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}&euro;</td>
                     <td><a href="{{route('product.removeFromCart',$product->id)}}">Delete</a></td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
                @if(Cart::getTotalQuantity() > 0)
                <strong>Total Quantity: {{ Cart::getTotalQuantity()}}<br>Total: {{ Cart::getSubTotal() }}&euro;</strong><br>
                <a href="{{route('client.downloadPDFcart')}}" target="_blank">Generate PDF</a>
                @endif
          </div>
        </div>
            @if(Cart::getTotalQuantity() > 0)
            <div class="card-footer">
                <a class="btn btn-primary" href="{{route('product.getCheckout')}}" >Checkout</a>
            </div>
            @endif
      </div>

    </div>
    <!-- /.container-fluid -->
  </div>

    </main>


    @include('inc.footer')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js')}}"></script> {{-- your js --}}
</body>
</html>
