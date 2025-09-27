@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Security Guard Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $securityGuard->user->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $securityGuard->user->email }}</p>
            {{-- <p class="card-text"><strong>Phone:</strong> {{ $securityGuard->phone ?: 'N/A' }}</p>
            <p class="card-text"><strong>Company:</strong> {{ $securityGuard->company ?: 'N/A' }}</p> --}}
            {{-- @if($securityGuard->photo)
                <p class="card-text"><strong>Photo:</strong> <img src="{{ $securityGuard->photo }}" alt="Photo" width="100"></p>
            @endif --}}
        </div>
    </div>

    <a href="{{ route('security-guards.edit', $securityGuard) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('security-guards.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
