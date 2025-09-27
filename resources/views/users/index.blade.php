@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Users')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Users')

{{-- Content body: main page content --}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    {{-- <th>Mobile</th> --}}
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users ?? [] as $user)
                                    <tr>
                                        <td>{{ $user->id ?? '' }}</td>
                                        <td>{{ $user->name ?? '' }}</td>
                                        <td>{{ $user->email ?? '' }}</td>
                                        {{-- <td>{{ $user->mobile ?? '' }}</td> --}}
                                        <td>{{ implode(', ',$user->roles()->pluck('name')->toArray() ?? []) }}</td>
                                        <td>
                                            @if ($user->status=='active')

                                            <form action="users/deactivate/{{$user->id}}"  method="post">
                                                @csrf
                                                <input type="submit" value="Deactivate" class="btn btn-danger btn-sm">
                                            
                                            </form>
                                            @else
                                            <form action="users/activate/{{$user->id}}" method="post" >
                                                @csrf
                                                <input type="submit" value="Activate" class="btn btn-success btn-sm">
                                            </form>
                                                
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>  

@stop

{{-- Push extra CSS --}}

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/columncontrol/1.1.0/css/columnControl.dataTables.min.css">
@endpush

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/columncontrol/1.1.0/js/dataTables.columnControl.min.js"></script>

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
