@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Visit Details</h1>

    <div class="card">
        <div class="card-body">
            <p class="card-text"><strong>Visitor:</strong> {{ $visit->visitor->name }}</p>
            <p class="card-text"><strong>Attendant:</strong> {{ $visit->attendant }}</p>
            <p class="card-text"><strong>Purpose:</strong> {{ $visit->purpose ?: 'N/A' }}</p>
            <p class="card-text"><strong>HOD:</strong> {{ $visit->HOD ?: 'N/A' }}</p>
            <p class="card-text"><strong>Prebooked:</strong> {{ $visit->prebooked ? 'Yes' : 'No' }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $visit->created_at->format('Y-m-d H:i') }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $visit->updated_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('visits.edit', $visit) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('visits.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
