@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Visit</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('visits.update', $visit) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="visitor_id" class="form-label">Visitor</label>
            <select name="visitor_id" id="visitor_id" class="form-select" required>
                <option value="">Select Visitor</option>
                @foreach($visitors as $visitor)
                    <option value="{{ $visitor->id }}" {{ old('visitor_id', $visit->visitor_id) == $visitor->id ? 'selected' : '' }}>{{ $visitor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="attendant" class="form-label">Attendant</label>
            <select name="attendant" id="attendant" class="form-select" required>
                <option value="">Select Attendant</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('attendant', $visit->attendant) == $employee->id ? 'selected' : '' }}>{{ $employee->user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="purpose" class="form-label">Purpose</label>
            <input type="text" name="purpose" id="purpose" class="form-control" value="{{ old('purpose', $visit->purpose) }}">
        </div>

        <div class="mb-3">
            <label for="HOD" class="form-label">HOD</label>
            <input type="text" name="HOD" id="HOD" class="form-control" value="{{ old('HOD', $visit->HOD) }}">
        </div>

        <div class="mb-3">
            <label for="prebooked" class="form-label">Prebooked</label>
            <select name="prebooked" id="prebooked" class="form-select">
                <option value="0" {{ old('prebooked', $visit->prebooked) == '0' ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('prebooked', $visit->prebooked) == '1' ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Visit</button>
        <a href="{{ route('visits.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
