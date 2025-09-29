@extends('layouts.app')

@section('subtitle', 'Employee')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Employee')

@section('content')
    <div class="container">
        <h1>Add Employee</h1>

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
                        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" required name="name" id="name" class="form-control"
                                    value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" required name="email" id="email" class="form-control"
                                    value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" required name="position" id="position" class="form-control"
                                    value="{{ old('position') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="number" required min="1000000000" max="99999999999" name="phone"
                                    id="phone" class="form-control" value="{{ old('phone') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address (optional)</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ old('address') }}">
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Employee</button>
                            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
