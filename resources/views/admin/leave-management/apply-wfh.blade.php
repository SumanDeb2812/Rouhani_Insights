{{-- {{ print_r($leave) }} --}}
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
            <a class="admin-side-menu-button" href="/admin/leave-management"><i class="fa fa-address-book" style="margin-right: 10px;"></i> My Leaves</a>
            <a class="admin-side-menu-button" href="/admin/apply-leave"><i class="fa fa-pencil-square" style="font-size: 15px; margin-right: 10px;"></i> Apply Leave</a>
            <a class="admin-side-menu-button active-dash-btn" href="/admin/apply-wfh"><i class="fa fa-bed" style="margin-right: 10px;"></i> Apply WFH</a>
        </div>
    </div>
    <h3><i class="fa fa fa-bed"></i> Apply Work From Home</h3>
    <div class="admin-table-content">
            <div class="apply-wfh-form-div">
                <form action="{{ route('leave.apply') }}" method="post">
                    @csrf
                    <div class="input-box">
                        <label for="">Duration</label>
                        <div class="date-box-outer">
                            <div class="date-box">
                                <label for="">From Date</label>
                                <input type="date" name="leave-from-date" id="leave-from-date">
                            </div>
                            <div class="date-box">
                                <label for="">To Date</label>
                                <input type="date" name="leave-to-date" id="leave-to-date">
                            </div>
                        </div>
                        @error('leave-from-date')
                        <p style="color: red; margin: 5px 0 0 5px; font-size: 14px;">{{ $message }}</p>
                        @enderror
                        @error('leave-to-date')
                        <p style="color: red; margin: 5px 0 0 5px; font-size: 14px;">{{ $message }}</p>
                        @enderror
                        <div class="date-box-outer">
                            <div id="leave-day"></div>
                            <input type="hidden" id="leave-count" name="leave-taken">
                        </div>
                    </div>
                    <div class="input-box">
                        <label for="">Reason</label>
                        <textarea name="leave-reason" id="" cols="30" rows="3"></textarea>
                        @error('leave-reason')
                        <p style="color: red; margin: 5px 0 0 5px; font-size: 14px;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-box">
                        <label for="">Upload your worklog here</label>
                        <input type="file" name="leave-file" id="">
                        <p style="color: red; margin: 5px 0 0 5px; font-size: 14px;" id="medical-leave-special"></p>
                    </div>
                    <input type="submit" value="Submit" id="apply-wfh-btn" class="mb-3">
                </form>
            </div>
            @if(session()->has('success'))
            <div class="alert alert-success mt-3">
                {{ session()->get('success') }}
            </div>
            @endif
    </div>
</div>

@endsection