@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="d-print-none" >Visitor Details</h1>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="text-bold"> Name : {{ $visitor->name }}</h5>
                        <p class="card-text"><strong>Email:</strong> {{ $visitor->email }}</p>
                        <p class="card-text"><strong>Mobile:</strong> {{ $visitor->mobile ?: 'N/A' }}</p>
                        <p class="card-text"><strong>Address:</strong> {{ $visitor->address ?: 'N/A' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="card-text"><strong>Company Name:</strong> {{ $visitor->company_name ?: 'N/A' }}</p>
                        <p class="card-text"><strong>ID Proof:</strong> {{ $visitor->id_proof ?: 'N/A' }}</p>
                        <p class="card-text"><strong>First Visited On :</strong>
                            {{ $visitor->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="card-text"><strong>Photo:</strong> <img class="img-fluid w-100"
                                src="/secure-photo/{{ $visitor->id }}" alt="      "></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="card-text"><strong>Photo of ID:</strong> <img class="img-fluid w-100"
                                src="/secure-id-photo/{{ $visitor->id }}" alt="      "></p>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="d-print-none" onclick="window.print()">Print This Page</button>
        <a href="{{ route('visitors.edit', $visitor) }}" class="btn btn-warning mt-3 d-print-none">Edit</a>
        <a href="{{ route('visitors.index') }}" class="btn btn-secondary mt-3 d-print-none">Back to List</a>
    </div>
@endsection
