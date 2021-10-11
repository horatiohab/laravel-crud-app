@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Employees</h1>
</div>
<div class="row">
    <div class="card  mx-auto">
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <form method="GET" action="{{ route('employees.index') }}">
                        <div class="form-row align-items-center">
                            <div class="col">
                                <input type="search" name="search" class="form-control mb-2" id="inlineFormInput"
                                    placeholder="Search...">
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary mb-2">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div>
                    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-2">Create</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Country</th>
                        <th scope="col">City</th>
                        <th scope="col">Company</th>
                        <th scope="col">Department</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr>
                        <th>{{ $employee->id }}</th>
                        <th>{{ $employee->first_name }}</th>
                        <th>{{ $employee->last_name }}</th>
                        <th>{{ $employee->email }}</th>
                        <th>{{ $employee->phone_number }}</th>
                        <th>{{ $employee->country_id }}</th>
                        <th>{{ $employee->city_id }}</th>
                        <th>{{ $employee->company_id }}</th>
                        <th>{{ $employee->department_id }}</th>
                        <td>
                            <form action="{{ route('employees.destroy',$employee->id) }}" method="POST">
                                <a class="btn btn-primary" href="{{ route('employees.edit',$employee->id) }}">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection