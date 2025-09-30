<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Visit</title>
    <style>
        .table {
            border-collapse: collapse;
        }

        .page {
            width: 100%;
        }

        td {
            padding: 5px;
        }
    </style>
</head>
@php
    $setting = ['get' => fn($k, $d = null) => \App\Models\Setting::get($k, $d)];
@endphp

<body>
    <div class="page">
        <table width="100%" >
            <tr>
                <td width="15%" >
                    <img style="display:inline-block;max-height:200px;max-width:200px"  src="{{ $logo_src }}"
                        alt="">
                </td>
                <td >
                    <h2 style="text-align:right" >
                        @if ($setting['get']('print_visit_pass_header'))
                                {{ $setting['get']('print_visit_pass_header') }}
                        @else
                                {{ env('APP_NAME') }}
                        @endif
                    </h2>
                </td>
            </tr>
        </table>

        <h4 style="text-align:center">Visiting Pass</h4>
        <table border="1" style="border-collapse:collapse;width:100%">
            <tr>
                <td width="40%">Date : {{ $visit->created_at->format('Y-m-d') }}</td>
                <td width="40%">Sr. No:{{ $visit->id }}</td>

                <td rowspan="6" colspan="2">
                    <div class="" style="text-align:center;vertical-align:center;">
                        <img style="display:inline-block;max: height 200px;" width="100px" src="{{ $src }}"
                            alt="">
                    </div>
                </td>
            </tr>
            <tr>
                <td>In Time : {{ $visit->created_at->format('h:i:s A') }}</td>
                <td>Out Time : </td>

            </tr>
            <tr>
                <td>Name of Visitor : {{ $visit->visitor->name }} </td>
                <td>Whom To Meet : {{ $visit->employee->user->name }} </td>

            </tr>
            <tr>
                <td>From Location : {{ $visit->visitor->address }} </td>
                <td>From Company : {{ $visit->visitor->company_name }} </td>
            </tr>
            <tr>
                <td>Purpose of Meeting : {{ $visit->purpose }} </td>

                <td>Contact Number : {{ $visit->visitor->mobile }} </td>
            </tr>
            <tr>
                <td>Document Proof : {{ $visit->visitor->id_proof }} </td>
                <td colspan>Document Proof Number : {{ $visit->visitor->id_proof_number }} </td>
            </tr>
            <tr class="bottom-row">
                <td colspan="4">
                    <table border="0" style="width:100%;border: 0px solid transparent;border-collapse:collapse ">
                        <tr>
                            <td style="text-align:center;"> <br> &nbsp;<br> &nbsp; <br> &nbsp;<br> &nbsp; Security Sign
                            </td>
                            <td style="text-align:center;"> <br> &nbsp;<br> &nbsp; <br> &nbsp;<br> &nbsp; Visitor's Sign
                            </td>
                            <td style="text-align:center;"> <br> &nbsp;<br> &nbsp; <br> &nbsp;<br> &nbsp; Employee's
                                Sign</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
