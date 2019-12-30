@extends('layouts.app')

@section('content')
<h2 class="text-center">All Employees</h2>
<ul class="list-group py-3 mb-3">
    @forelse($employees as $employee)
    <li class="list-group-item my-2">
        <a href="{{route('employees.show',$employee->id)}}">
            <h5>{{$employee->first_name}} {{$employee->last_name}}</h5>
            <p>{{$employee->salary}}&euro;</p>
            <small class="float-right">{{$employee->created_at->diffForHumans()}}</small>
        </a>
    </li>
    @empty
    <h4 class="text-center">No Employees Found!</h4>
    @endforelse
</ul>
<div class="d-flex justify-content-center">
    {{$employees->links()}}
</div>
@endsection
