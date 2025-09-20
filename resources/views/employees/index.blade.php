@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Employees</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add Employee</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

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
                                <a href="{{ route('employees.show', $employee) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="btn btn-danger btn-sm">Delete</button>
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
@endsection
