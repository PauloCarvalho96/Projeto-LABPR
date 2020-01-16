@extends('layouts.app')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Show Clients</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Email</th>
                  <th>Nome</th>
                </tr>
              </thead>
              <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name}}</td>
                    <td><a href="{{ route('products.removeUser', $user->id) }}" class="btn btn-danger">Delete User</a></td>
                </tr>
                @empty
                    <h4 class="text-center">No Clients Found!</h4>
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
    {{$users->links()}}
  </div>
@endsection
