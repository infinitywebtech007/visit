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
                    <form action="/report-by-date" method="get">
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
                        <input type="submit" value="submit">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4>Report Employee Wise</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <form action="/report-by-employee">
                                <div class="form-group">
                                    <lable class="lable">Employee</lable>
                                    <select class="form-control" name="employee_id" id="employee_id">
                                        @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }} "> {{$employee->user->name }} </option>
                                        @endforeach
                                    </select>
                                </div>                            
                                <input type="submit" value="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <form action="/report-by-visitor">
            <div class="card">
                <div class="card-body">
                    <h4>Report Visitor Wise</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <lable class="lable">Visitors</lable>
                                <select required class="form-control" name="visitor_id" id="visitor_id">
                                    @foreach ($visitors as $visitor)
                                    <option value="{{ $visitor->id }} "> {{$visitor->id }} </option>
                                    @endforeach
                                </select>
                            </div>                            
                        </div>
                    </div>
                    <input type="submit" value="submit">
                </div>
            </div>
            </form>
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