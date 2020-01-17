        <img class="img-thumbnail" src="{{ public_path() }}/img/logo.png" alt="Logo" height="150px">

        <div class="card-header py-3">
          <h4 class="m-0 font-weight-bold text-primary">Payment Receipt</h4>
          <h6 class="font-weight-bold text-primary">{{Auth::user()->name }}</h6>
          <h6 class="font-weight-bold text-primary">{{$dados[0]['address'] }}</h6>
          <h6 class="font-weight-bold text-primary">{{$dados[0]['city'] }}</h6>
          <h6 class="font-weight-bold text-primary">{{$dados[0]['postalcode'] }}</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Quantity</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                {{!$products = Cart::getContent()}}
                @if($products)
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->price }}&euro;</td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
                <strong>Total Quantity:{{ Cart::getTotalQuantity()}}<br>Total: {{ Cart::getSubTotal() }}&euro;</strong>
          </div>
        </div>

