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
                <x-adminlte-small-box title="Today Passes" text="{{ $todayVisitsCount ?? '-' }}" icon="fas fa-calendar-day text-white" theme="purple"/>
            </div>
            <div class="col-sm-12 col-md-4">
                <x-adminlte-small-box title="Open Passes" text="{{ $openVisitsCount ?? '-' }}" icon="fas fa-list text-white" theme="teal"/>
            </div>
            <div class="col-sm-12 col-md-4">
                <x-adminlte-small-box title="Monthly Passes" text="{{ $totalVisitsCountMonth ?? '-' }}" icon="fas fa-calendar-alt text-white" theme="pink"/>
            </div>
           
{{-- Themes --}}


    <div style="width: 800px;"><canvas id="acquisitions"></canvas></div>

    <!-- <script type="module" src="dimensions.js"></script> -->
    <script type="module" >
        // import Chart from 'chart.js/auto'

(async function() {
  const data = [
    { year: 2010, count: 10 },
    { year: 2011, count: 20 },
    { year: 2012, count: 15 },
    { year: 2013, count: 25 },
    { year: 2014, count: 22 },
    { year: 2015, count: 30 },
    { year: 2016, count: 28 },
  ];

  new Chart(
    document.getElementById('acquisitions'),
    {
      type: 'bar',
      data: {
        labels: data.map(row => row.year),
        datasets: [
          {
            label: 'Acquisitions by year',
            data: data.map(row => row.count)
          }
        ]
      }
    }
  );
})();

    </script>


        </div>
    </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.ChartJs', true)
{{-- @section('plugins class="Chartjs"></plugins>', true) --}}
@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush