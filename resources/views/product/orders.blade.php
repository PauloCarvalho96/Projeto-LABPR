@extends('layouts.app')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Clients Orders</h6>
        </div>

        <div class="card-body">
            <div class="my-4">
                <form action="{{ route('products.search_orders') }}" method="GET" role="search">
                      @csrf
                      <div class="input-group">
                          <input type="text" class="form-control" name="query" placeholder="Search Orders by email">
                            <button type="submit" class="btn btn-primary">Search</button>
                            </span>
                          </div>
                    </form>
                </div>

          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Order number</th>
                  <th>User</th>
                  <th>Total Price</th>
                  <th>PDF</th>
                </tr>
              </thead>
              <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->user_email}}</td>
                    <td>{{ $order->valor_total}}&euro;</td>
                    <td><a href="{{ route('products.orderPDF', $order->pdf) }}" target="_blank">{{ $order->pdf}}</a></td>
                </tr>
                @empty
                    <h4 class="text-center">No Orders Found!</h4>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->
  </div>
  <div class="d-flex justify-content-center">
    {{$orders->links()}}
  </div>
@endsection
