@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Security Guard</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('security-guards.update', $securityGuard) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" required name="name" id="name" class="form-control"
                                    value="{{ old('name', $securityGuard->user->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" required name="email" id="email" class="form-control"
                                    value="{{ old('email', $securityGuard->user->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone"
                                    id="phone" class="form-control" value="{{ old('phone', $securityGuard->phone) }}">
                            </div>
                            <div class="mb-3">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" name="company" id="company" class="form-control"
                                    value="{{ old('company', $securityGuard->company) }}">
                            </div>  
                            <button type="submit" class="btn btn-primary">Update Security Guard</button>
                            <a href="{{ route('security-guards.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
