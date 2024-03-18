{{-- {{ print_r(session()->all()) }} --}}
@extends('admin.layout.lavel-1-layout')

@section('main-content')
<div class="admin-header">
    <div class="admin-header-sub">
        <img src="{{ asset('website/images/logo2.png') }}" alt="">
        <div class="dashboard-user">
            <div class="show-role">
            @if(session()->get('active_role') == 1) <p style="color: Red">Admin</p>
            @elseif (session()->get('active_role') == 2) <p style="color: Green">Manager</p>
            @elseif (session()->get('active_role') == 3) <p style="color: Blue">Employee</p>
            @elseif (session()->get('active_role') == 4) <p style="color: deeppink">Leave Admin</p>
            @elseif (session()->get('active_role') == 5) <p style="color: darkmagenta">Forwarding</p>
            @elseif (session()->get('active_role') == 6) <p style="color: darkorange">Reporting</p>
            @endif
            </div>
            <h6>Welcome, {{ session()->get('emp_fname') }}</h6>
            <i class="fa fa-user-circle"></i>
            <a href="{{ route('logout') }}"><button style="margin-left: 20px;">Logout</button></a>
        </div>
    </div>
</div>
<div class="dashboarb-body">
    <div class="side-menu-dashboard">
        @include('admin.layout.side-menu')
    </div>
    <div class="mainloadbody">
        <h2><i class="fa fa-dashboard"></i> Dashboard</h2>
        @if (isset($result))
        <div class="role-change-option">
            <form action="{{ route('change.role') }}" method="post" class="role_changing-form">
                @csrf
                <div>
                    <select class="role_changing-box" name="role_id" id="">
                        <option value="">Change Role</option>
                        @foreach ($result as $row)
                        <option value="{{ $row->role_id }}">{{ $row->role_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input class="role_changing-btn" type="submit" value="Change" id="role_change">
                </div>
            </form>
            @error('role_id')
                <span>{{ $message }}</span>
            @enderror
        </div>
        @endif
        <?php 
        // if($_SESSION['wb_role_id'] == 3){
        ?>
        {{-- <div class="attendance-register">
            <h6>Register Attendance</h6> --}}
            <?php
                // $result3 = mysqli_query($conn, "SELECT in_time, out_time FROM hrd_emp_ad WHERE emp_id = '{$_SESSION["emp_id"]}' AND DATE_FORMAT(in_time, '%d-%m') = DATE_FORMAT(NOW(), '%d-%m')") or die("Query Failed");
                // if(mysqli_num_rows($result3) > 0){
                //     while($row3 = mysqli_fetch_assoc($result3)){
                //         echo '<a><button class="in-time-dactive">In</button></a>';
                //         echo "<span>In time: " . date('h:ia', strtotime($row3['in_time'])) . "</span>";
                //         if($row3['out_time'] != null){
                //             echo '<a><button class="out-time-dactive">Out</button></a>';
                //         }else{
                //             echo '<a href="attendance-manager/out-time-register.php"><button class="out-time-active">Out</button></a>';
                //         }
                //     }
                // }else{
                //     echo '<a href="attendance-manager/in-time-register.php"><button class="in-time-active">In</button></a>';
                //     echo "<span>In time: </span>";
                //     echo '<a><button class="out-time-dactive">Out</button></a>';
                // }
            ?>
        {{-- </div> --}}
        <?php
        // }
        ?>
    </div>
</div>
{{-- <div id="leave-request-notification">
    <i class="fa fa-times" id="close-notification"></i>
</div> --}}
<div id="notification-box-outer">
    <p>Notification</p>
    <div id="notification-box"></div>
</div>
<div id="leave-request-notification">
    <span id="notification-count"></span>
    <i class="fa fa-bell" id="notification-bell"></i>
</div>

@endsection