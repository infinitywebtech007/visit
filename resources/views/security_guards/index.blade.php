@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Security Personnel')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Security Personnel')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="d-inline">Security Personnel</h1>
                <a href="{{ route('security-guards.create') }}" class="btn bg-teal mb-4 float-right"><div class="fa fa-plus"></div></a>

            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @if ($securityGuards->count())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Company</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($securityGuards as $securityGuard)
                                        <tr>
                                            <td>{{ $securityGuard->user->name }}</td>
                                            <td>{{ $securityGuard->user->email }}</td>
                                            <td>{{ $securityGuard->phone ?: 'N/A' }}</td>
                                            <td>{{ $securityGuard->company ?: 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('security-guards.show', $securityGuard) }}" class="btn bg-teal btn-sm"><div class="fa fa-eye"></div></a>
                                                <a href="{{ route('security-guards.edit', $securityGuard) }}" class="btn bg-teal btn-sm"><div class="fa fa-edit"></div></a>
                                                <form action="{{ route('security-guards.destroy', $securityGuard) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                        class="btn btn-danger btn-sm"><div class="fa fa-trash"></div></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                
                            {{ $securityGuards->links() }}
                        @else
                            <p>No security guards found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
