@extends('admin.layout.lavel-1-layout')

@section('main-content')
@if (session()->has('ftl_msg'))
<div id="first-time-login-msg">
    <p><i class="fa fa-times" id="cancel-ftl-msg"></i>{{ session()->get('ftl_msg') }}</p>
</div>
@endif
<div class="admin-header">
    <div class="admin-header-sub">
        <img src="{{ asset('website/images/logo2.png') }}" alt="">
    </div>
</div>
<div class="dashboarb-body">
    <div class="employee-list-table-sp">
        <div class="add-employee-form-box">
            <p class="set-password-heading">Set your new password</p>
            <form action="{{ route('set.password') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="emp_id" id="emp_name" value="{{ session()->get('emp_id') }}">
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Enter your new password</label>
                        <input type="password" name="emp_new_password" id="emp_new_password">
                        @error('emp_new_password')
                        <p style="margin-top: 5px; margin-bottom: -10px; color: red; font-size: 14px; font-weight: bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Confirm your new password</label>
                        <input type="password" name="emp_new_con_password" id="emp_new_con_password" onkeyup="matchPassword()">
                        @error('emp_new_con_password')
                        <p style="margin-top: 5px; margin-bottom: -10px; color: red; font-size: 14px; font-weight: bold">{{ $message }}</p>
                        @enderror
                        <p id="password_err" style="color: red; margin-top: 5px; font-size: 14px; font-weight: 600;"></p>
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <button type="submit" name="set_password" class="add-employee-btn" style="margin-top: -20px;">Change Password</button>
                </div>
            </form>
            @error('set-password-error')
            <p style="margin-top: -10px; color: red; font-size: 14px; font-weight: bold">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<script>
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

    document.getElementById('cancel-ftl-msg').addEventListener('click', function(){
        document.getElementById('first-time-login-msg').style.display = "none";
    });
</script>
@endsection