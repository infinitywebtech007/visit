@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <x-adminlte-info-box title="Active Visits" text="{{ $openVisitsCount }}" url="/visits" iconTheme="  " icon="fa fa-file" theme="teal"></x-adminlte-info-box>
            </div>
            <div class="col-sm-12 col-md-4">
                <x-adminlte-info-box title="Active Visits" text="{{ $openVisitsCount }}" url="/visits" iconTheme="  " icon="fa fa-file" theme="teal"></x-adminlte-info-box>
            </div>
            <div class="col-sm-12 col-md-4">
                <x-adminlte-info-box title="Active Visits" text="{{ $openVisitsCount }}" url="/visits" iconTheme="  " icon="fa fa-file" theme="teal"></x-adminlte-info-box>
            </div>
        </div>
    </div>
@stop


@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush