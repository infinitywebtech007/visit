@extends('layouts.app')

@section('subtitle', 'Create Pass')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Create Pass')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="d-inline">List of Visits</h1>
                @haspermission('visits-create')
                    <a href="{{ route('visits.create') }}" class="btn bg-teal m-2 float-right">
                        <div class="fa fa-plus"></div>
                    </a>
                @endhaspermission
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Visitor</th>
                                    <th>Empl</th>
                                    <th>Purpose</th>
                                    <th>Date</th>
                                    <th>In</th>
                                    <th>Out</th>
                                    {{-- <th>Closed by</th> --}}
                                    <th>Actions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visits as $visit)
                                    <tr>
                                        <td>{{ $visit->id }}</td>
                                        <td>{{ $visit->visitor->name ?? 'N/A' }}</td>
                                        <td>{{ $visit->employee->user->name ?? 'N/A' }}</td>
                                        <td>{{ $visit->purpose }}</td>
                                        <td>{{ $visit->prebooked ? 'Yes' : 'No' }}</td>
                                        <td>{{ $visit->in_time ?? '' }}</td>
                                        <td>{{ $visit?->out_time ?? '' }}</td>
                                        <td>
                                            @if (is_null($visit?->out_time))
                                                <x-adminlte-button data-id="{{ $visit->id }}"
                                                    data-name="{{ $visit->visitor->name }}"
                                                    class="btn btn-sm bg-teal rounded" data-toggle="modal"
                                                    data-target="#closeVisit" label="Close">
                                                </x-adminlte-button>
                                            @endif

                                            <a class="btn bg-teal btn-sm" target="_blank"
                                                href="/visit-print/{{ $visit->id }}">
                                                <div class="fa fa-print"></div>
                                            </a>

                                            @haspermission('visits-view')
                                                <a href="{{ route('visits.show', $visit) }}" class="btn bg-teal btn-sm">
                                                    <div class="fa fa-eye"></div>
                                                </a>
                                            @endhaspermission

                                            @haspermission('visits-edit')
                                                <a href="{{ route('visits.edit', $visit) }}" class="btn bg-teal btn-sm">
                                                    <div class="fa fa-edit"></div>
                                                </a>
                                            @endhaspermission

                                            @haspermission('visits-delete')
                                                <form action="{{ route('visits.destroy', $visit) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                        class="btn bg-danger btn-sm">
                                                        <div class="fa fa-trash"></div>
                                                    </button>
                                                </form>
                                            @endhaspermission
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <x-adminlte-modal id="closeVisit" title="Visits">
                            <p id="visitCloseTitle">Set out time for visit</p>
                            <form action="/visits/{{ $id ?? '' }}" id="visitCloseForm" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="out_time" class="form-label">Out Time</label>
                                    <input type="time" name="out_time" id="out_time" value="{{ date('H:i') }}"
                                        class="form-control" required>
                                </div>
                                <input type="submit" class="btn bg-teal" value="Set Out Time">
                            </form>
                            <x-slot name="footerSlot">
                            </x-slot>
                        </x-adminlte-modal>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

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
                responsive: true,
                order: [
                    [0, 'desc']
                ]
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

    <script>
        var visitClose = document.getElementById('closeVisit')
        $('#closeVisit').on('show.bs.modal', function(event) {
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var visitId = button.getAttribute('data-id')
            var visitorName = button.getAttribute('data-name')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var visitCloseTitle = visitClose.querySelector('#visitCloseTitle')
            var visitCloseForm = visitClose.querySelector('#visitCloseForm')
            var outTimeInput = visitClose.querySelector('#out_time')

            var formUrl = '/visits/close/' + visitId

            visitCloseTitle.textContent = 'Set Out Time for ' + visitorName + ' ( Visit ID : ' + visitId + ')'
            visitCloseForm.action = formUrl
            const now = new Date();
            const tzTime = new Date(now.getTime());
            outTimeInput.value = tzTime.getHours().toString().padStart(2, '0') + ':' + tzTime.getMinutes()
                .toString().padStart(2, '0');
        })
    </script>
@endpush
