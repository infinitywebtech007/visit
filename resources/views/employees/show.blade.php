@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employee Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $employee->user->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $employee->user->email }}</p>
            <p class="card-text"><strong>Position:</strong> {{ $employee->position }}</p>
            <p class="card-text"><strong>Phone:</strong> {{ $employee->phone }}</p>
            <p class="card-text"><strong>Address:</strong> {{ $employee->address ?: 'N/A' }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $employee->status }}</p>
            @if($employee->profile_photo_path)
                <p class="card-text"><strong>Profile Photo:</strong> <img src="{{ $employee->profile_photo_path }}" alt="Profile Photo" width="100"></p>
            @endif
        </div>
    </div>

    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
