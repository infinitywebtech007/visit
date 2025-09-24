@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Reports')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Reports')

{{-- Content body: main page content --}}

@section('content')
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush