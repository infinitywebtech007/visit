@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content')
<div class="container">

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered" id=myTable>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Company</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitors as $visitor)
                                <tr>
                                    <td>{{ $visitor->name }}</td>
                                    <td>{{ $visitor->email }}</td>
                                    <td>{{ $visitor->mobile ?: 'N/A' }}</td>
                                    <td>{{ $visitor->company_name ?: 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('visitors.show', $visitor) }}"
                                            class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('visitors.edit', $visitor) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('visitors.destroy', $visitor) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                                class="btn btn-danger btn-sm">Delete</button>
                                        </form>
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
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">

@endpush

{{-- Push extra scripts --}}

@push('js')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>

<link href="https://cdn.datatables.net/columncontrol/1.1.0/css/columnControl.dataTables.min.css" rel="stylesheet">
  
<script src="https://cdn.datatables.net/columncontrol/1.1.0/js/dataTables.columnControl.min.js"></script>

    <script>

        new DataTable('#myTable', {
            columnControl: [
                { extend: 'order' },
                [{ extend: 'orderAsc' }, { extend: 'orderDesc' }, { extend: 'search' }]
            ]
        });
    </script>

    
@endpush


