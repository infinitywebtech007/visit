@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Visitors</h1>
    <a href="{{ route('visitors.create') }}" class="btn btn-primary mb-3">Add Visitor</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($visitors->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Company</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visitors as $visitor)
            <tr>
                <td>{{ $visitor->name }}</td>
                <td>{{ $visitor->email }}</td>
                <td>{{ $visitor->mobile ?: 'N/A' }}</td>
                <td>{{ $visitor->company_name ?: 'N/A' }}</td>
                <td>
                    <a href="{{ route('visitors.show', $visitor) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('visitors.edit', $visitor) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('visitors.destroy', $visitor) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- {{ $visitors->links() }} --}}
    @else
    <p>No visitors found.</p>
    @endif
</div>
@endsection
