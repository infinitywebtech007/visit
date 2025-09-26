@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Change Password')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Change Password')

{{-- Content body: main page content --}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-span-12">
                <div class="card">
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="" method="post">
                            @csrf
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td>Name</td>
                                    <td>{{ Auth::user()->name }}</td>
                                </tr>
                                <tr>
                                    <td>Current Password</td>
                                    <td>
                                        <input type="password" class="form-control" name="current_password">
                                        @error('current_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td>New Password</td>
                                    <td>
                                        <input type="password" class="form-control" name="new_password">
                                        @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td>Confirm New Password</td>
                                    <td>
                                        <input type="password" class="form-control" name="new_password_confirmation">
                                        @error('new_password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                </tr>
                            </table>
                            <input type="submit" value="Change" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush