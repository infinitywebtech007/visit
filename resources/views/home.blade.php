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
                <x-adminlte-small-box title="Today Passes" text="{{ $todayVisitsCount ?? '-' }}"
                    icon="fas fa-calendar-day text-white" theme="purple" />
            </div>
            <div class="col-sm-12 col-md-4">
                <x-adminlte-small-box title="Open Passes" text="{{ $openVisitsCount ?? '-' }}" icon="fas fa-list text-white"
                    theme="teal" />
            </div>
            <div class="col-sm-12 col-md-4">
                <x-adminlte-small-box title="Monthly Passes" text="{{ $totalVisitsCountMonth ?? '-' }}"
                    icon="fas fa-calendar-alt text-white" theme="pink" />
            </div>

            {{-- Chart Section --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bar Chart</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="acquisitions"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.ChartJs', true)

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}
@push('js')
    <script>
        (function() {
            const data = @json($chart_data);

            new Chart(
                document.getElementById('acquisitions'), {
                    type: 'bar',
                    data: {
                        labels: data.map(row => row.date),
                        datasets: [{
                            label: 'Visits per date',
                            data: data.map(row => row.count),
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            y: {
                                beginAtZero: true, // Start at zero
                                min: 0, // Minimum value is 0 (bottom)
                                max: 10, // Maximum value is 10 (top) - ensures at least 10 points on axis even if data max is low (e.g., 1)
                                ticks: {
                                    stepSize: 1 // Steps: 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10
                                }
                            },
                            x: {
                                beginAtZero: true, // Start at zero
                                min: 0, // Minimum value is 0 (bottom)
                                max: 10, // Maximum value is 10 (top) - ensures at least 10 points on axis even if data max is low (e.g., 1)
                                ticks: {
                                    stepSize: 1 // Steps: 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10
                                }
                            }
                        }
                    }
                }
            );
        })();
    </script>
@endpush