@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Reports')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Reports')

{{-- Content body: main page content --}}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Visitor Name</td>
                            <td>Employee Name</td>
                            <td>Purpose</td>
                            <td>Date Time</td>
                        </tr>
                        @foreach ($visits as $visit)
                            <tr>
                                <td>{{ $visit->visitor->name }}</td>
                                <td>{{ $visit->employee->user->name }}</td>
                                <td>{{ $visit->purpose }}</td>
                                <td>{{ $visit->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
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