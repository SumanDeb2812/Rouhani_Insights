{{-- {{ print_r(session()->all()) }} --}}
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
            <a class="admin-side-menu-button" href="/admin/employee-management"><i class="fa fa-address-book" style="margin-right: 10px;"></i> Employee List</a>
            <a class="admin-side-menu-button active-dash-btn" href="/admin/add-employee"><i class="fa fa-user-plus" style="margin-right: 10px;"></i> Add Employee</a>
        </div>
    </div>
    <h3><i class="fa fa-user-plus" style="margin-right: 10px;"></i>Add a new employee</h3>
    <div class="employee-list-table-ane">
        <div class="add-employee-form-box">
            <form action="{{ route('employee.addNew') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">First Name</label>
                        <input type="text" name="emp_fname" id="emp_name">
                        @error('emp_fname')
                        <p style="margin-top: 5px; font-size: 14px; color: red; font-weight: bold; margin-bottom: -10px">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Middle Name</label>
                        <input type="text" name="emp_mname" id="emp_name">
                        @error('emp_mname')
                        <p style="margin-top: 5px; font-size: 14px; color: red; font-weight: bold; margin-bottom: -10px">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Last Name</label>
                        <input type="text" name="emp_lname" id="emp_name">
                        @error('emp_lname')
                        <p style="margin-top: 5px; font-size: 14px; color: red; font-weight: bold; margin-bottom: -10px">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Employee ID</label>
                        <input type="text" name="emp_id" id="emp_id">
                        @error('emp_id')
                        <p style="margin-top: 5px; font-size: 14px; color: red; font-weight: bold; margin-bottom: -10px">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Date of Birth</label>
                        <input type="date" name="emp_dob" id="emp_dob">
                        @error('emp_dob')
                        <p style="margin-top: 5px; font-size: 14px; color: red; font-weight: bold; margin-bottom: -10px">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Phone No.</label>
                        <input type="tel" name="emp_phone" id="emp_phone">
                        @error('emp_phone')
                        <p style="margin-top: 5px; font-size: 14px; color: red; font-weight: bold; margin-bottom: -10px">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Email ID</label>
                        <input type="email" name="emp_email" id="emp_email">
                        @error('emp_email')
                        <p style="margin-top: 5px; font-size: 14px; color: red; font-weight: bold; margin-bottom: -10px">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Designation</label>
                        <input type="text" name="emp_desg" id="emp_desg">
                        @error('emp_desg')
                        <p style="margin-top: 5px; font-size: 14px; color: red; font-weight: bold; margin-bottom: -10px">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Joining Date</label>
                        <input type="date" name="emp_join_date" id="emp_dob">
                        @error('emp_join_date')
                        <p style="margin-top: 5px; font-size: 14px; color: red; font-weight: bold; margin-bottom: -10px">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div-1">
                        <div class="add-employee-form-sub-div">
                            <input type="hidden" name="emp_password" id="emp_password">
                        </div>
                    </div>
                </div>
                <div class="add-employee-form-div d-flex justify-content-center">
                    <button type="submit" name="add_emp" class="add-employee-btn" onclick="generate_password()">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function generate_password() {
        let emp_password = document.getElementById('emp_password');
        emp_password.value = Math.random().toString(32).slice(2);
    }
</script>
@endsection