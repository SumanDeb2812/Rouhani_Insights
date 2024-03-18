@php
$dirURI = $_SERVER['REQUEST_URI'];
$compo = explode('/', $dirURI);
$page = $compo[2];
@endphp
<div class="admin-side-menu">
    <a href="/admin/dashboard" class="admin-side-menu-button @if($page == 'dashboard') active-dash-btn @endif"><i class="fa fa-dashboard" style="margin-right: 10px;"></i> Dashboard</a>
    @if (session()->get('active_role') == 1)
    <a class="admin-side-menu-button" @if($page == 'employee-management') active-dash-btn @endif" href="/admin/employee-management"><i class="fa fa-users" style="margin-right: 10px;"></i> Employees</a>
    <a class="admin-side-menu-button @if($page == 'web-auth') active-dash-btn @endif" href="/admin/web-auth"><i class="fa fa-lock" style="margin-right: 10px;"></i> Authorization</a>
    {{-- <a class="admin-side-menu-button" href="attendance-manager/employee-attendance.php"><i class="fa fa-book" style="margin-right: 10px;"></i> Attendance</a> --}}
    @endif
    @if (session()->get('active_role') == 2)
    <a class="admin-side-menu-button" href="/admin/employee-management"><i class="fa fa-users" style="margin-right: 10px;"></i> Employees</a>
    {{-- <a class="admin-side-menu-button" href="attendance-manager/employee-attendance.php"><i class="fa fa-book" style="margin-right: 10px;"></i> Attendance</a> --}}
    @endif
    @if (session()->get('active_role') == 3)
    <a class="admin-side-menu-button @if($page == 'my-profile') active-dash-btn @endif" href="/admin/my-profile"><i class="fa fa-user" style="margin-right: 10px;"></i> My Profile</a>
    {{-- <a class="admin-side-menu-button" href="attendance-manager/my-attendance.php"><i class="fa fa-book" style="margin-right: 10px;"></i> My Attendance</a> --}}
    @endif
    @if(session()->get('active_role') != 2)
    <a class="admin-side-menu-button" href="/admin/leave-management"><i class="fa fa-share-square" style="margin-right: 10px;"></i> Leave Management</a>
    @endif
    {{-- <a class="admin-side-menu-button" href="holiday-and-birthday/holidays-and-birthdays.php">Holidays & Birthdays</a>
    <a class="admin-side-menu-button" href="seasonal-message-manager.php">Upload Seasonal Message</a>
    <a class="admin-side-menu-button" href="add-post/news_post.php">Blog Management</a> --}}
</div>