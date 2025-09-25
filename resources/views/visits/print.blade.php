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
            width : 50%;
        }
    </style>
</head>

<body>
    <div class="page">

        <h2>

            <center>
                Visit Managemnt System
            </center>
        </h2>

        <table border="1" style="border-collapse:collapse;width:100%">
            <tr>
                <td width="50%">Date : {{ $visit->created_at->format('Y-m-d') }}</td>
                <td>Sr. No:{{ $visit->id }}</td>
            </tr>
            <tr>
                <td>In Time : {{ $visit->created_at->format('h:i:s A') }}</td>
                <td>Out Time : </td>
            </tr>
            <tr>
                <td colspan="2">Name of Visitor : {{ $visit->visitor->name }} </td>
            </tr>
            <tr>
                <td colspan="2">From Company : {{ $visit->visitor->company_name }} </td>
            </tr>
            <tr>
                <td colspan="2">From Location : {{ $visit->visitor->address }} </td>
            </tr>
            <tr>
                <td colspan="2">Whom To Meet : {{ $visit->employee->user->name }} </td>
            </tr>
            <tr>
                <td colspan="2">Purpose of Meeting : {{ $visit->purpose }} </td>
            </tr>
            <tr>
                <td colspan="2">Contact Number : {{ $visit->visitor->mobile }} </td>
            </tr>
            <tr class="bottom-row">
                <td colspan="2">
                    <table border="0" style="width:100%;border: 0px solid transparent;border-collapse:collapse ">
                        <tr>
                            <td>Security Sign <br> &nbsp;<br> &nbsp; </td>
                            <td>Visitor's Sign <br> &nbsp;<br> &nbsp; </td>
                            <td>Employee's Sign <br> &nbsp;<br> &nbsp; </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
