@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Visit Details</h1>

    <div class="card">
        <div class="card-body">
            <div class="row">
                
                <div class="col-sm-6">
                    <p class="card-text"><strong>Visitor:</strong> {{ $visit->visitor->name }}</p>
                    <p class="card-text"><strong>Employee:</strong> {{ $visit->employee->user->name }}</p>
                </div>
                <div class="col-sm-6">
                    <p class="card-text"><strong>Visit Date:</strong> {{ $visit->created_at->format('Y-m-d H:i') }}</p>
                    <p class="card-text"><strong>Purpose:</strong> {{ $visit->purpose ?: 'N/A' }}</p>

                </div>
            </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="card-text"><strong>Photo:</strong> <img class="img-fluid w-100"
                                src="/secure-photo/{{ $visit->visitor->id }}" alt="      "></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="card-text"><strong>Photo of ID:</strong> <img class="img-fluid w-100"
                                src="/secure-id-photo/{{ $visit->visitor->id }}" alt="      "></p>
                    </div>
                </div>
            {{-- <p class="card-text"><strong>Prebooked:</strong> {{ $visit->prebooked ? 'Yes' : 'No' }}</p> --}}
        </div>
    </div>
        
                    <a class="btn btn-dark btn-sm" href="/visit-print/{{ $visit->id }}">Print</a>
    
    <a href="{{ route('visits.edit', $visit) }}" class="btn btn-warning mt-3 d-print-none">Edit</a>
    <a href="{{ route('visits.index') }}" class="btn btn-secondary mt-3 d-print-none">Back to List</a>
</div>
@endsection
