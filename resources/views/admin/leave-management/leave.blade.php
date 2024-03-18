@extends('admin.layout.lavel-1-layout')

@section('main-content')

@if (session()->get('active_role') != 3 and session()->get('active_role') != 2)
    <div id="reject-leave-box">
        <div class="reject-leave-main">
            <form action="" method="post" onsubmit="validateForm()" id="reject-form">
                @csrf
                <label for="">Reason for rejection</label>
                <textarea name="reject-reason" id="reject-reason" cols="50" rows="5"></textarea>
                <p id="leave-reject-error"></p>
                <input type="submit" value="Submit" id="reject-leave-btn">
            </form>
        </div>
        <a><i class="fa fa-times" id="close-reject-box"></i></a>
    </div>
@endif

<div class="admin-header">
    <div class="admin-header-sub">
        <img src="{{ asset('website/images/logo2.png') }}" alt="">
        <div class="dashboard-user">
            <a href="/admin/dashboard"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
</div>
<div class="dashboarb-body">
    <div class="side-menu-dashboard">
        <div class="admin-side-menu">
            @if (session()->get('active_role') == 3)
                <a class="admin-side-menu-button active-dash-btn" href="/admin/leave-management"><i class="fa fa-share-square" style="margin-right: 10px;"></i> My Leaves</a>
                <a class="admin-side-menu-button" href="/admin/apply-leave"><i class="fa fa-pencil-square" style="font-size: 15px; margin-right: 10px;"></i> Apply Leave</a>
                <a class="admin-side-menu-button" href="/admin/apply-wfh"><i class="fa fa-bed" style="margin-right: 10px;"></i> Apply WFH</a>
            @elseif (session()->get('active_role') == 1 or session()->get('active_role') == 4)
                <a class="admin-side-menu-button active-dash-btn" href="/admin/leave-management"><i class="fa fa-share-square" style="margin-right: 10px;"></i> Leaves</a>
                <a class="admin-side-menu-button" href="/admin/assign-leave"><i class="fa fa-pencil-square" style="margin-right: 10px;"></i> Assign Leave</a>
                <a class="admin-side-menu-button" href="/admin/leave-report"><i class="fa fa-newspaper" style="margin-right: 10px;"></i> Leave Report</a>
            @elseif (session()->get('active_role') == 5 or session()->get('active_role') == 6)
                <a class="admin-side-menu-button active-dash-btn" href="/admin/leave-management"><i class="fa fa-share-square" style="margin-right: 10px;"></i> Leaves</a>
                <a class="admin-side-menu-button" href="/admin/leave-report"><i class="fa fa-newspaper" style="margin-right: 10px;"></i> Leave Report</a>
            @endif
        </div>
    </div>
    <h3><i class="fa fa-share-square"></i> Leave Management</h3>
    @if (session()->get('active_role') == 3)
    <div class="admin-table-content">
        @if(isset($result))
        <div class="leave-table-content">
            <table>
                <thead>
                    <tr>
                        <th>Leave Id</th>
                        <th>Type</th>
                        <th>Duration</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Reason</th>
                        <th>Applied On</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $row)
                    <tr>
                        <td>{{ $row->leave_id }}</td>
                        <td>{{ $row->leave_type }}</td>
                        <td>{{ $row->leave_taken }} @if($row->leave_taken > 1)days @else day @endif</td>
                        <td>{{ date('d/m/Y', strtotime($row->leave_from_date)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($row->leave_to_date)) }}</td>
                        <td>{{ $row->leave_reason }}</td>
                        <td>{{ date('d/m/Y', strtotime($row->applied_on)) }}</td>
                        <td>
                        @if($row->leave_status == '1')
                            <span class="badge badge-sm bg-secondary">To Frowarding</span>
                        @elseif($row->leave_status == '2')
                            <span class="badge badge-sm bg-primary">To Reporting</span>
                        @elseif($row->leave_status == '3')
                            <i class="fa fa-check" style="color: green; border: 2px solid green; border-radius: 25px; padding: 2px;"></i>
                        @elseif($row->leave_status == '4')
                        <i class="fa fa-times" style="color: red; border: 2px solid red; border-radius: 25px; padding: 2px 3px"></i>
                        @endif
                        </td>
                        <td>
                        @if($row->leave_status == '1')
                            <a class="btn btn-sm btn-danger" href="/admin/cancel-leave/{{ $row->leave_id }}"><i class="fa fa-trash"></i></a>
                        @elseif ($row->leave_status != '1')
                            <a class="btn btn-sm btn-danger disabled"><i class="fa fa-trash"></i></a>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-leave-paginate">
            <a href="{{ $result->previousPageUrl() }}"><i class="fa fa-arrow-left"></i></a>
            <span>{{ $result->currentPage() }}</span>
            <a href="{{ $result->nextPageUrl() }}"><i class="fa fa-arrow-right"></i></a>
        </div>
        @else
            <p style="font-weight: bold">No leave applied</p>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success mt-3">{{ session()->get('success') }}</div>
        @endif
        @error('leave_error')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
    </div>
    @elseif (session()->get('active_role') != 3 and session()->get('active_role') != 2)
    <div class="admin-table-content">
        @if(isset($result))
        <div class="leave-table-content">
            <table>
                <thead>
                    <tr>
                        <th>Leave Id.</th>
                        <th>Employee</th>
                        <th>Type</th>
                        <th>Duration</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Reason</th>
                        <th>Work Adjustment</th>
                        <th>Applied On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $row)
                    <tr>
                        <td>{{ $row->leave_id }}</td>
                        <td>{{ $row->emp_fname . " " . $row->emp_lname . " - " . $row->emp_id }}</td>
                        <td>{{ $row->leave_type }}</td>
                        <td>{{ $row->leave_taken }} @if($row->leave_taken > 1)days @else day @endif</td>
                        <td>{{ date('d/m/Y', strtotime($row->leave_from_date)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($row->leave_to_date)) }}</td>
                        <td>{{ $row->leave_reason }}</td>
                        <td>{{ $row->work_adjustment }}</td>
                        <td>{{ date('d/m/Y', strtotime($row->applied_on)) }}</td>
                        <td>
                            <a class="btn btn-sm btn-success" href="/admin/leave-approved/{{ $row->leave_id }}"> <i class="fa fa-thumbs-up"></i></a>
                            <button class="btn btn-sm btn-danger" value="{{ $row->leave_id }}" onclick="rejectLeave(this.value)"><i class="fa fa-thumbs-down"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p>No leave applied</p>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success mt-3">{{ session()->get('success') }}</div>
        @endif
        @error('leave_error')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
    </div>
    @endif
</div>

@endsection