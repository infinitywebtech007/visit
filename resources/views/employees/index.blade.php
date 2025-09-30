@extends('layouts.app')

@section('subtitle', 'Employees Master')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Employees Master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="d-inline mb-2">Employees</h1>
                <a href="{{ route('employees.create') }}" class="btn bg-teal float-right mb-4">
                    <div class="fa fa-plus"></div>
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card">
            <div class="card-body">
                @if ($employees->count())
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->id }}</td>
                                    <td>{{ $employee->user->name }}</td>
                                    <td>{{ $employee->user->email }}</td>
                                    <td>{{ $employee->position }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->status }}</td>
                                    <td>
                                        {{-- <a href="{{ route('employees.show', $employee) }}" class="btn btn-info btn-sm">View</a> --}}
                                        <a href="{{ route('employees.edit', $employee) }}" class="btn bg-teal btn-sm">
                                            <div class="fa fa-edit"></div>
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                                class="btn btn-danger btn-sm">
                                                <div class="fa fa-trash"></div>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $employees->links() }}
                @else
                    <p>No employees found.</p>
                @endif
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
@endpush
