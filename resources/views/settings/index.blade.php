@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Settings`')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Settings')

{{-- Content body: main page content --}}

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td>Key </td>
                        <td>Value  </td>
                    </tr>
                    @foreach ($settings ?? [] as $setting)
                        <tr>
                            <td>{{ $setting->key }}</td>
                            <td><input type="text" class="form-control" value="{{ $setting->value }}" ></td>
                        </tr>
                    @endforeach
                    <form action="" method="post">
                        @csrf
                        <tr>
                            <td><input type="text" name="key" placeholde="Enter key"></td>
                            <td><input type="text" name="value" placehoder="Enter value" >
                            <input type="submit" value="save"></td>
                        </tr>
                    </form>
                </table>
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