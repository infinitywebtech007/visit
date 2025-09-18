@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Visitor</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('visitors.update', $visitor) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $visitor->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $visitor->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="mobile" class="form-label">Mobile</label>
            <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile', $visitor->mobile) }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $visitor->address) }}">
        </div>

        <div class="mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name', $visitor->company_name) }}">
        </div>

        <div class="mb-3">
            <label for="photo_url" class="form-label">Photo URL</label>
            <input type="text" name="photo_url" id="photo_url" class="form-control" value="{{ old('photo_url', $visitor->photo_url) }}">
        </div>

        <div class="mb-3">
            <label for="id_proof" class="form-label">ID Proof</label>
            <input type="text" name="id_proof" id="id_proof" class="form-control" value="{{ old('id_proof', $visitor->id_proof) }}">
        </div>

        <div class="mb-3">
            <label for="id_proof_img" class="form-label">ID Proof Image URL</label>
            <input type="text" name="id_proof_img" id="id_proof_img" class="form-control" value="{{ old('id_proof_img', $visitor->id_proof_img) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Visitor</button>
        <a href="{{ route('visitors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
