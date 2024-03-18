@extends('admin.layout.lavel-1-layout')

@section('main-content')

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
            @if (session()->get('active_role') == 1 or session()->get('active_role') == 4)
                <a class="admin-side-menu-button" href="/admin/leave-management"><i class="fa fa-share-square" style="margin-right: 10px;"></i> Leaves</a>
                <a class="admin-side-menu-button" href="/admin/assign-leave"><i class="fa fa-pencil-square" style="margin-right: 10px;"></i> Assign Leave</a>
                <a class="admin-side-menu-button active-dash-btn" href="/admin/leave-report"><i class="fa fa-newspaper" style="margin-right: 10px;"></i> Leave Report</a>
            @elseif (session()->get('active_role') == 5 or session()->get('active_role') == 6)
                <a class="admin-side-menu-button" href="/admin/leave-management"><i class="fa fa-share-square" style="margin-right: 10px;"></i> Leaves</a>
                <a class="admin-side-menu-button active-dash-btn" href="/admin/leave-report"><i class="fa fa-newspaper" style="margin-right: 10px;"></i> Leave Report</a>
            @endif
        </div>
    </div>
    <div class="leave-main-div">
        <h3><i class="fa fa-share-square"></i> Leave Reports</h3>
        <span id="generate-leave-report-btn" class="btn btn-sm btn-danger"><i class="fa fa-file-excel" aria-hidden="true"></i></span>
    </div>
    <div class="admin-table-content">
        <div class="search-leave-outer">
            <div class="search-leave-inner">
                <label for="">Search By Name</label>
                <input type="search" name="" id="leave_name_search">
            </div>
            <div class="search-leave-inner">
                <div style="margin-right: 10px">
                    <label for="">From Date</label>
                    <input type="date" id="leave_from_date_search">
                </div>
                <div>
                    <label for="">To Date</label>
                    <input type="date" id="leave_to_date_search">
                </div>
            </div>
            <i title="clear filter" class="fa fa-trash" id="clear-leave-filter" style="cursor: pointer"></i>
        </div>
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
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="leave-report-tbody"></tbody>
            </table>
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success mt-3">{{ session()->get('success') }}</div>
        @endif
        @error('leave_error')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="leave-paginate">
        <i class="fa fa-arrow-left" id="first_page_leave_url"></i>
        <i class="fa fa-arrow-right" id="next_page_leave_url"></i>
    </div>
</div>

<div id="generate-leave-report-div-outer">
    <div class="generate-leave-report-div-inner">
        <button id="generate-leave-report-div-close">X</button>
        <h4>Generate Leave Report</h4>
        <form id="leave-filter-form">
            @csrf
            <div class="input-div">
                <label for="">Name</label>
                <select id="leave-report-name" name="emp_id">
                    <option value="">Select Any</option>
                    @if(isset($result))
                    @foreach ($result as $r)
                    <option value="{{ $r->emp_id }}">{{ $r->emp_fname . " "  . $r->emp_lname . " - " . $r->emp_id}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="input-div">
                <label for="">From Date</label>
                <input type="date" name="from_date" id="leave-report-from-date">
            </div>
            <div class="input-div">
                <label for="">To Date</label>
                <input type="date" name="to_date" id="leave-report-to-date">
            </div>
            <button class="btn btn-sm btn-warning" id="print_with_filter">Print With Filter</button>
            <span id="leave-report-error">Any of above field value is needed</span>
        </form>
        {{-- <a class="btn btn-sm btn-warning" href="{{ url('/admin/generate-leave-report-wofilter') }}">Print All Without Filter</a> --}}
        <button class="btn btn-sm btn-warning" id="print_without_filter">Print All Without Filter</button>
    </div>
</div>

<div class="" id="leave-report-preview-outer"></div>

@endsection