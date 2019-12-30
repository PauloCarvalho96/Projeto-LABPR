@extends('layouts.app')
@section('content')
    <h3 class="text-center">Create an Employee</h3>
    <form action="{{route('employees.store')}}" method="post">
        @csrf {{-- <- Required for protection or the form is rejected --}}
        <div class="form-group">
            <label for="title">First Name:</label>
            <input type="text" name="firstName" id="title" class="form-control" value="{{old('firstName')}}" placeholder="Enter the first name">
        </div>
        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" id="lastName" class="form-control" value="{{old('lastName')}}" placeholder="Enter the last name">
        </div>
        <div class="form-group">
            <label for="salary">Salary:</label>
            <input type="number" name="salary" id="salary" class="form-control" value="{{old('salary')}}" placeholder="Enter the salary">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
