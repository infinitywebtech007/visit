@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Security Personnel</h1>
        <a href="{{ route('security-guards.create') }}" class="btn btn-primary mb-3">Add Security Personnel</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($securityGuards->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($securityGuards as $securityGuard)
                        <tr>
                            <td>{{ $securityGuard->user->name }}</td>
                            <td>{{ $securityGuard->user->email }}</td>
                            <td>{{ $securityGuard->phone ?: 'N/A' }}</td>
                            <td>{{ $securityGuard->company ?: 'N/A' }}</td>
                            <td>
                                <a href="{{ route('security-guards.show', $securityGuard) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('security-guards.edit', $securityGuard) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('security-guards.destroy', $securityGuard) }}" method="POST"
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

            {{ $securityGuards->links() }}
        @else
            <p>No security guards found.</p>
        @endif
    </div>
@endsection
