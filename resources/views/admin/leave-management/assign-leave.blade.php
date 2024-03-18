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
            <a class="admin-side-menu-button" href="/admin/leave-management"><i class="fa fa-address-book" style="margin-right: 10px;"></i> Leaves</a>
            <a class="admin-side-menu-button active-dash-btn" href="/admin/assign-leave"><i class="fa fa-pencil-square" style="font-size: 15px; margin-right: 10px;"></i> Assign Leave</a>
            <a class="admin-side-menu-button" href="/admin/leave-report"><i class="fa fa-newspaper" style="margin-right: 10px;"></i> Leave Report</a>
            @endif
        </div>
    </div>
    <h3><i class="fa fa-pencil-square"></i> Assign Leave</h3>
    <div class="admin-table-content">
        <div class="leave-form-div">
            <div class="d-flex align-items-start justify-content-between">
                <form action="{{ route('leave.assign') }}" method="post" onsubmit="return submitForm()">
                    @csrf
                    <div class="leave-box-outer">
                        <div class="d-flex">
                            <div id="leave-type-clone-div">
                                <label for="">Leave Type</label>
                                <select name="leave-type[]" id="leave-type-clone" onchange="removeError()">
                                    <option value="">Select One</option>
                                    <option value="casual">Casual Leave</option>
                                    <option value="sick">Sick Leave</option>
                                    <option value="earned">Earned Leave</option>
                                    <option value="medical">Medical Leave</option>
                                </select>
                            </div>
                            <div id="emp-clone-div">
                                <label for="">Employee Name</label>
                                <select name="emp-id[]" id="emp-clone" onchange="removeError(); return catchDifference()">
                                    <option value="">Select One</option>
                                    @foreach ($result as $row)
                                    <option value="{{ $row->emp_id }}">{{ $row->emp_fname . " " . $row->emp_lname . " / " . $row->emp_id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="leave-count-clone-div">
                                <label for="">No of leaves</label>
                                <input type="number" name="leave-amount[]" id="leave-count-clone" onkeydown="removeError()">
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Submit" id="leave-assign-btn">
                    <div id="clone-error" class="mt-3"></div>
                </form>
                <div class="d-flex">
                    <button id="remove-leave-box-casual" onclick="removeClone()">Remove</button>
                    <button id="add-leave-box" onclick="makeClone()">Add</button>
                </div>
            </div>
            @if($errors->any())
                @foreach ($errors->all() as $error)
                <div class="mt-3 mb-3">{{ $error }}</div>
                @endforeach
            @endif
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success mt-5">
            {{ session()->get('success') }}
        </div>
        @endif
    </div>
</div>

@endsection