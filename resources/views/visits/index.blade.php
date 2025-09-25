@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Visits</h1>
    <a href="{{ route('visits.create') }}" class="btn btn-primary mb-3">Create Visit</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Visitor</th>
                <th>Employee</th>
                <th>Purpose</th>
                <th>HOD</th>
                <th>Prebooked</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visits as $visit)
            <tr>
                <td>{{ $visit->id }}</td>
                <td>{{ $visit->visitor->name ?? 'N/A' }}</td>
                <td>{{ $visit->employee->user->name ?? 'N/A' }}</td>
                <td>{{ $visit->purpose }}</td>
                <td>{{ $visit->HOD }}</td>
                <td>{{ $visit->prebooked ? 'Yes' : 'No' }}</td>
                <td>{{ $visit->created_at->format('Y-m-d H:i') }}</td>
                <td>
                                        <a class="btn btn-dark btn-sm" href="/visit-print/{{ $visit->id }}">Print</a>

                    <a href="{{ route('visits.show', $visit) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('visits.edit', $visit) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('visits.destroy', $visit) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
