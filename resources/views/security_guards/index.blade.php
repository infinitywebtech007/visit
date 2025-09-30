@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Security Personnel')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Security Personnel')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="d-inline">Security Personnel</h1>
                <a href="{{ route('security-guards.create') }}" class="btn bg-teal mb-4 float-right"><div class="fa fa-plus"></div></a>

            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @if ($securityGuards->count())
                            <table class="table table-bordered" id="myTable" >
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Company</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($securityGuards as $securityGuard)
                                        <tr>
                                            <td>{{ $securityGuard->user->id }}</td>
                                            <td>{{ $securityGuard->user->name }}</td>
                                            <td>{{ $securityGuard->user->email }}</td>
                                            <td>{{ $securityGuard->phone ?: 'N/A' }}</td>
                                            <td>{{ $securityGuard->company ?: 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('security-guards.show', $securityGuard) }}" class="btn bg-teal btn-sm"><div class="fa fa-eye"></div></a>
                                                <a href="{{ route('security-guards.edit', $securityGuard) }}" class="btn bg-teal btn-sm"><div class="fa fa-edit"></div></a>
                                                <form action="{{ route('security-guards.destroy', $securityGuard) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                        class="btn btn-danger btn-sm"><div class="fa fa-trash"></div></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                
                            {{ $securityGuards->links() }}
                        @else
                            <p>No security guards found.</p>
                        @endif
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
@endpush
