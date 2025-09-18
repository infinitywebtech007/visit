@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Visitor Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $visitor->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $visitor->email }}</p>
            <p class="card-text"><strong>Mobile:</strong> {{ $visitor->mobile ?: 'N/A' }}</p>
            <p class="card-text"><strong>Address:</strong> {{ $visitor->address ?: 'N/A' }}</p>
            <p class="card-text"><strong>Company Name:</strong> {{ $visitor->company_name ?: 'N/A' }}</p>
            <p class="card-text"><strong>Photo URL:</strong> {{ $visitor->photo_url ?: 'N/A' }}</p>
            <p class="card-text"><strong>ID Proof:</strong> {{ $visitor->id_proof ?: 'N/A' }}</p>
            <p class="card-text"><strong>ID Proof Image:</strong> {{ $visitor->id_proof_img ?: 'N/A' }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $visitor->created_at->format('Y-m-d H:i') }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $visitor->updated_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('visitors.edit', $visitor) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('visitors.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
