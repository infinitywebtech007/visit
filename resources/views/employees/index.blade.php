@extends('layouts.app')

@section('subtitle', 'Employees Master')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Employees Master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="d-inline mb-2">Employees</h1>
                <a href="{{ route('employees.create') }}" class="btn bg-teal float-right mb-4"><div class="fa fa-plus"></div></a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card">
            <div class="card-body">
                @if ($employees->count())
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->user->name }}</td>
                                    <td>{{ $employee->user->email }}</td>
                                    <td>{{ $employee->position }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->status }}</td>
                                    <td>
                                        {{-- <a href="{{ route('employees.show', $employee) }}" class="btn btn-info btn-sm">View</a> --}}
                                        <a href="{{ route('employees.edit', $employee) }}" class="btn bg-teal btn-sm"><div class="fa fa-edit"></div></a>
                                        <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                                class="btn btn-danger btn-sm"><div class="fa fa-trash"></div></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
        
                    {{ $employees->links() }}
                @else
                    <p>No employees found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
