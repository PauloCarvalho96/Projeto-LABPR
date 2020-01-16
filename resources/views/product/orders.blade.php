@extends('layouts.app')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Clients Orders</h6>
        </div>
        <div class="card-body">
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
                    {{!$client = User::findOrFail($order->user_id)}}
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $client->email}}</td>
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

@endsection
