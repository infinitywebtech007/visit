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
                    <h4>Report Date Wise</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <lable class="lable">From</lable>
                                <input type="date" name="from_date" id="from_date" class="form-control">
                            </div>                            
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <lable class="lable">To</lable>
                                <input type="date" name="to_date" id="to_date" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4>Report Employee Wise</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <lable class="lable">From</lable>
                                <input type="date" name="from_date" id="from_date" class="form-control">
                            </div>                            
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <lable class="lable">To</lable>
                                <input type="date" name="to_date" id="to_date" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4>Report Visitor Wise</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <lable class="lable">From</lable>
                                <input type="date" name="from_date" id="from_date" class="form-control">
                            </div>                            
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <lable class="lable">To</lable>
                                <input type="date" name="to_date" id="to_date" class="form-control">
                            </div>
                        </div>
                    </div>
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