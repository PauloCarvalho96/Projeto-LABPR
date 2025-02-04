@extends('layouts.app')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Clients Orders</h6>
        </div>
        <div class="card-body">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <form action="{{ route('products.search_orders') }}" method="GET" role="search">
            @csrf
            <div class="row align-items-end">
              <div class="col-3 col-md-2">
                <label for="category"></label>
                <select name="search" class="form-control" id="title">
                  <option name="id">Id</option>
                  <option name="email">Email</option>
                </select>
              </div>
              <div class="col-15 col-md-10">
                <div class="input-group">
                  <input type="text" class="form-control" name="query" placeholder="Search Orders by email / id">
                  <button type="submit" class="btn btn-primary">Search</button>
                </div>
              </div>
            </div>
          </form>
          </table>

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
