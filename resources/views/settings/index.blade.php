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
                <form action="/settings"  method="post" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <td>Key </td>
                            <td>Value  </td>
                        </tr>
                        @foreach ($settings ?? [] as $setting)
                            <tr>
                                
                                <td><input type="text" readonly class="form-control" value="{{ $setting->key }}" ></td>
                                <td><input type="text" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}" ></td>
                            </tr>
                        @endforeach
                                <td><img style="max-width:50px;max-height:50px" src="" /></td>
                                <td><input type="file" name="print_pass_logo" id="" class="form-control"></td>
                    </table>
                    <input type="submit" value="Save" class="btn bg-teal">
                </form>
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