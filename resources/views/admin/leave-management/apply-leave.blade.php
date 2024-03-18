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
            <a class="admin-side-menu-button active-dash-btn" href="/admin/apply-leave"><i class="fa fa-pencil-square" style="font-size: 15px; margin-right: 10px;"></i> Apply Leave</a>
            <a class="admin-side-menu-button" href="/admin/apply-wfh"><i class="fa fa-bed" style="margin-right: 10px;"></i> Apply WFH</a>
        </div>
    </div>
    <h3><i class="fa fa-pencil-square"></i> Apply Leave</h3>
    <div class="admin-table-content">
        @if(isset($result1) and isset($emp) and isset($leave))
            <div class="my-leaves-box-outer">
                @foreach ($leave as $l)
                    <div class="leave-box-inner">
                        <p style="margin-bottom: 5px; font-weight: bold">{{ strtoupper($l->leave_type) . " " . 'LEAVE' }}</p>
                        <div class="d-flex justify-content-between">
                            @foreach ($result1 as $r)
                            @if ($l->leave_type == $r->leave_type)
                            <p><b>Total</b> - {{ $r->leave_amount }}</p> 
                            @endif
                            @endforeach
                            <p><b>Already taken</b> - {{$l->leave_count }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="apply-leave-form-div">
                <form action="{{ route('leave.apply') }}" method="post">
                    @csrf
                    <div class="input-box-outer">
                        <div class="input-box">
                            <label for="">Leave Type</label>
                            <select name="leave-type" id="leave-type">
                                <option value="">Select One</option>
                                @foreach ($leave as $l)
                                @foreach ($result1 as $r)
                                @if($l->leave_type == $r->leave_type)
                                @if($l->leave_count < $r->leave_amount)
                                <option value="{{ $r->leave_type }}">{{ $r->leave_type }}</option>
                                @endif
                                @endif
                                @endforeach
                                @endforeach
                            </select>
                            @error('leave-type')
                            <p style="color: white; margin: 5px 0 0 5px; font-size: 14px;">{{ $message }}</p>
                            @enderror
                        </div>
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
                            <p style="color: white; margin: 5px 0 0 5px; font-size: 14px;">{{ $message }}</p>
                            @enderror
                            @error('leave-to-date')
                            <p style="color: white; margin: 5px 0 0 5px; font-size: 14px;">{{ $message }}</p>
                            @enderror
                            <div class="date-box-outer">
                                <div id="leave-day" style="color: white"></div>
                                <input type="hidden" id="leave-count" name="leave-taken">
                            </div>
                        </div>
                    </div>
                    <div class="input-box-outer">
                        <div class="input-box">
                            <label for="">Work Adjustment Request</label>
                            <select name="work-adjustment" id="">
                                <option value="">Choose a employee</option>
                                @foreach ($emp as $e)
                                <option value="{{ $e->emp_id }}">{{ $e->emp_fname . " " . $e->emp_lname . " - " . $e->emp_id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-box">
                            <label for="">Upload Documents</label>
                            <input type="file" name="leave-file" id="">
                            <p style="color: white; margin: 5px 0 0 5px; font-size: 14px;" id="medical-leave-special"></p>
                        </div>
                    </div>
                    <div class="input-box-outer">
                        <div class="input-box">
                            <label for="">Reason</label>
                            <textarea name="leave-reason" id="" rows="3"></textarea>
                            @error('leave-reason')
                            <p style="color: white; font-size: 14px;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <input type="submit" value="Submit" id="apply-leave-assign-btn" class="mb-3">
                </form>
            </div>
        @elseif(isset($result1) and !isset($emp) and isset($leave))
            <div class="my-leaves-box-outer">
                @foreach ($leave as $l)
                    <div class="leave-box-inner">
                        <p style="margin-bottom: 5px; font-weight: bold">{{ strtoupper($l->leave_type) . " " . 'LEAVE' }}</p>
                        <div class="d-flex justify-content-between">
                            @foreach ($result1 as $r)
                            @if ($l->leave_type == $r->leave_type)
                            <p><b>Total</b> - {{ $r->leave_amount }}</p> 
                            @endif
                            @endforeach
                            <p><b>Already taken</b> - {{$l->leave_count }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <span>You already finished your all leaves</span>
        @else
            <span>You have no leaves yet to apply, please contact your officials</span>
        @endif
        @if(session()->has('success'))
            <p style="color: green; margin-top: 10px; font-weight: 600;">{{ session()->get('success') }}</p>
        @endif
        @error('leave-exceed')
            <p style="color: red; margin-top: 10px; font-weight: 600;">{{ $message }}</p>
        @enderror
    </div>
</div>

@endsection