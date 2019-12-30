@extends('layouts.app')
@section('content')
    <h3 class="text-center">Edit employee</h3>
    <form action="{{route('employees.update',$employee->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">First Name:</label>
            <input type="text" name="firstName" id="title" class="form-control" value="{{ old('firstName') ? : $employee->first_name }}" placeholder="Enter the first name">
        </div>
        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" id="lastName" class="form-control" value="{{ old('lastName') ? : $employee->last_name }}" placeholder="Enter the last name">
        </div>
        <div class="form-group">
            <label for="salary">Salary:</label>
            <input type="number" name="salary" id="salary" class="form-control" value="{{ old('salary') ? : $employee->salary }}" placeholder="Enter the salary">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
