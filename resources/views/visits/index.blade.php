@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Visits</h1>
    @haspermission('visits-create')
        <a href="{{ route('visits.create') }}" class="btn bg-teal mb-3">Create</a>
    @endhaspermission
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
                                        <a class="btn bg-teal btn-sm" target="_blank" href="/visit-print/{{ $visit->id }}"><div class="fa fa-print"></div></a>

                    @haspermission('visits-view')
                    <a href="{{ route('visits.show', $visit) }}" class="btn bg-teal btn-sm"><div class="fa fa-eye"></div></a>
                    @endhaspermission

                    @haspermission('visits-edit')
                    <a href="{{ route('visits.edit', $visit) }}" class="btn bg-teal btn-sm"><div class="fa fa-edit"></div></a>
                    @endhaspermission
                    
                    @haspermission('visits-delete')
                    <form action="{{ route('visits.destroy', $visit) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn bg-danger btn-sm"><div class="fa fa-trash"></div></button>
                    </form>
                    @endhaspermission
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
