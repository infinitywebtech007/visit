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
                    <table class="table table-bordered" id="myTable" >
                        <thead>
                            <tr>
                                <td>Visitor Name</td>
                                <td>Employee Name</td>
                                <td>Purpose</td>
                                <td>Visit Date (In Time)</td>
                                <td>Visit Date (Out Time)</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visits as $visit)
                            <tr>
                                <td>{{ $visit->visitor->name }}</td>
                                <td>{{ $visit->employee->user->name }}</td>
                                <td>{{ $visit->purpose }}</td>
                                <td>{{ $visit->created_at }}</td>
                                <td>{{ $visit->out_time ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="toolbar"></div>

                </div>
            </div>
        </div>
    </div>
</div>
@stop

{{-- Push extra CSS --}}

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">
@endpush


@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>

    <link href="https://cdn.datatables.net/columncontrol/1.1.0/css/columnControl.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/columncontrol/1.1.0/js/dataTables.columnControl.min.js"></script>

    
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>


    <script>
        $(document).ready(function() {
            let table = new DataTable('#myTable', {
                columnControl: [{
                        extend: 'order'
                    },
                    [{
                        extend: 'orderAsc'
                    }, {
                        extend: 'orderDesc'
                    }, {
                        extend: 'search'
                    }]
                ],
                layout: {
                    topStart: {
                        buttons: [
                            'copy', 'excel', 'pdf'
                        ]
                    }
                },
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ],
                pageLength: 10,
                responsive: true
            });

            new DataTable.Buttons(table, {
                buttons: [
                    'copy',
                    {
                        extend: 'excel',
                        title: 'Visitors Data'
                    },
                    {
                        extend: 'pdf',
                        title: 'Visitors Data'
                    },
                    {
                        extend: 'print',
                        title: 'Visitors Data'
                    }
                ]
            });

            table.buttons().container()
                .appendTo('#toolbar');
        });
    </script>
@endpush