@foreach ($result as $row)
    <tr>
        <td>{{ $row->leave_id }}</td>
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