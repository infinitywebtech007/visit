@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Visit</h1>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="mb-3">
                <label for="visitor_id" class="form-label">Visitor</label>
                 @livewire('visitors')

            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <label for="attendant" class="form-label">Attendant</label>
            <select name="attendant" id="attendant" class="form-control" required>
                <option value="">Select Attendant</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->user->id }}">{{ $employee->user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4">
            <label for="purpose" class="form-label">Purpose</label>
            <input type="text" name="purpose" id="purpose" class="form-control" value="{{ old('purpose') }}">
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4">
            <label for="HOD" class="form-label">HOD</label>
            <input type="text" name="HOD" id="HOD" class="form-control" value="{{ old('HOD') }}">
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 form-check">
            <input type="checkbox" name="prebooked" id="prebooked" class="form-check-input" value="1" {{ old('prebooked') ? 'checked' : '' }}>
            <label for="prebooked" class="form-check-label">Prebooked</label>
        </div>
        
    </div>
    <form action="{{ route('visits.store') }}" method="POST">
        @csrf

 

        <div class="col-sm-12 col-md-6 col-lg-4">

        </div>



        <button type="submit" class="btn btn-primary">Create Visit</button>
    </form>
</div>
@endsection
