@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Visit Details</h1>

        <div class="card">
            <div class="card-body">
                <div class="row">

                </div>
                <div class="row">

                    <div class="col-sm-5">
                        <p class="card-text mb-0"><strong>Sr:</strong> {{ $visit->id }}</p>
                        <p class="card-text mb-0"><strong>In Time:</strong> {{ $visit->created_at->format('H:i:s') }}</p>
                        <p class="card-text mb-0"><strong>Name of Visitor:</strong> {{ $visit->visitor->name }}</p>
                        <p class="card-text mb-0"><strong>From Company :</strong>
                            {{ $visit->visitor->company_name ?? 'N/A' }}</p>
                        <p class="card-text mb-0"><strong>Purpose of Meeting :</strong> {{ $visit->purpose }}</p>
                        <p class="card-text mb-0"><strong>ID Proof Document :</strong> {{ $visit->visitor->id_proof }}</p>
                    </div>
                    <div class="col-sm-5">
                        <p class="card-text mb-0 "><strong>Date:</strong> {{ $visit->created_at->format('Y-m-d') }}</p>
                        <p class="card-text mb-0 "><strong>OutTime:</strong> {{ $visit->out_time?->format('H:i:s') ?? '-' }}
                        </p>
                        <p class="card-text mb-0"><strong>Whom to Meet :</strong> {{ $visit->employee->user->name }}</p>
                        <p class="card-text mb-0 "><strong>From Location :</strong> {{ $visit->visitor->address }}</p>
                        <p class="card-text mb-0 "><strong>Contact Number :</strong> {{ $visit->visitor->mobile ?? 'N/A' }}
                        </p>
                        <p class="card-text mb-0 "><strong>ID Proof Number :</strong>
                            {{ $visit->visitor->id_proof_number ?? 'N/A' }}</p>

                    </div>
                    <div class="col-sm-2">
                        <p class="card-text"><strong>Photo of Visitor:</strong> <img class="img-fluid w-100"
                                src="/secure-photo/{{ $visit->visitor->id }}" alt="      "></p>
                    </div>
                </div>
                <div class="row mt-3 pt-1">
                    <div class="col-sm12">
                        <div class="accordion" id="accordionExample">
                            <h5 class="mb-0">
                                <button class="btn btn-link bg-secondary" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    View Document Photo
                                </button>
                            </h5>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong class="text-center">Photo of Document</strong>
                                        <img class="img-fluid w-100" src="/secure-id-photo/{{ $visit->visitor->id }}"
                                            alt="      ">
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- <p class="card-text"><strong>Prebooked:</strong> {{ $visit->prebooked ? 'Yes' : 'No' }}</p> --}}
            </div>
        </div>

        <a class="btn bg-teal btn mt-3" target="_blank" href="/visit-print/{{ $visit->id }}">
            <div class="fa fa-print"></div>
        </a>

        <a href="{{ route('visits.edit', $visit) }}" class="btn bg-teal mt-3 d-print-none">
            <div class="fa fa-edit"></div>
        </a>
        <a href="{{ route('visits.index') }}" class="btn btn-secondary mt-3 d-print-none">
            <fa class="fa fa-left-arrow">Back</fa>
        </a>
    </div>
@endsection
