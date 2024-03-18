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
            <a class="admin-side-menu-button" href="my-profile"><i class="fa fa-user" style="margin-right: 10px;"></i> My Profile</a>
            <a class="admin-side-menu-button" href="manage-profile"><i class="fa fa-pencil" style="margin-right: 10px;"></i> Manage Profile</a>
            <a class="admin-side-menu-button active-dash-btn" href="reset-password"><i class="fa fa-key" style="margin-right: 10px;"></i> Reset Password</a>
        </div>
    </div>
    <h3><i class="fa fa-key" style="margin-right: 10px;"></i>Reset your password</h3>
    <div class="employee-list-table-rp">
        <div class="add-employee-form-box">
            <form action="{{ route('employee.resetPassword') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Enter your old password</label>
                        <input type="password" name="emp_old_password" id="emp_name">
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Enter your new password</label>
                        <input type="password" name="emp_new_passowrd" id="emp_new_password">
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Confirm your new password</label>
                        <input type="password" name="emp_new_con_password" id="emp_new_con_password" onkeyup="matchPassword()">
                        <p id="password_err" style="color: red; margin-top: 5px; font-size: 14px; font-weight: 600;"></p>
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <button type="submit" class="add-employee-btn">Change Password</button>
                </div>
            </form>
            @error('password-reset-error')
                <p style="color: red; margin-top: -20px; font-weight: 600; font-size: 14px">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<script type="text/javascript">
    function matchPassword(){
        let new_passowrd = document.querySelector('#emp_new_password').value;
        let con_password = document.querySelector('#emp_new_con_password').value;
        let password_err = document.getElementById('password_err');
        if(new_passowrd != con_password){
            password_err.innerHTML = "Password and confirm password not matched!";
        }else{
            password_err.innerHTML = "";
        }
    }
</script>
@endsection