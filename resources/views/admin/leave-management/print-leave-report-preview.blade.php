<head>
    <link rel="stylesheet" media="print" href="{{ asset('admin/print.css') }}">
</head>

<div class="leave-report-preview">
    <h4>LEAVE REPORT</h4>
    <table>
        <thead>
            <tr>
                <th>Employee</th>
                <th>Type</th>
                <th>Duration</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Reason</th>
                <th>Work Adjustment</th>
                <th>Applied On</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $row)
            <tr>
                <td>{{ $row->emp_fname . " " . $row->emp_lname . " - " .  $row->emp_id}}</td>
                <td>{{ $row->leave_type }}</td>
                <td>{{ $row->leave_taken }}</td>
                <td>{{ date('d/m/Y', strtotime($row->leave_from_date)) }}</td>
                <td>{{ date('d/m/Y', strtotime($row->leave_to_date)) }}</td>
                <td>{{ $row->leave_reason }}</td>
                <td>@if ($row->work_adjustment == null)
                    <span class="text-danger">No appoinment</span>
                @else
                    {{ $row->work_adjustment }}
                @endif
            </td>
                <td>{{ $row->applied_on }}</td>
                <td>@if ($row->leave_status == 3)
                        <span class="badge bg-success"><i class="fa fa-thumbs-up"></i></span>
                    @else
                        <span class="badge bg-danger"><i class="fa fa-thumbs-down"></i></span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        <button onclick="window.print()">Print</button>
        <button onclick="cancelPrint()">Cancel</button>
    </div>
</div>