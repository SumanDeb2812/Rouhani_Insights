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
            <a class="admin-side-menu-button active-dash-btn" href="/admin/employee-management"><i class="fa fa-address-book" style="margin-right: 10px;"></i> Employee List</a>
            <a class="admin-side-menu-button" href="/admin/add-employee"><i class="fa fa-user-plus" style="margin-right: 10px;"></i> Add Employee</a>
        </div>
    </div>
    <h3><i class="fa fa-address-book" style="margin-right: 10px;"></i>Employee List</h3>
    <div class="employee-list-table">
        <table>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Email Id</th>
                    <th>Phone No.</th>
                    <th>D.O.B</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $row)
                    <tr>
                        <td><b><a style="text-decoration: none;" href="{{ url('admin/employee-deatil') }}/{{ $row->emp_id }}">{{ $row->emp_id }}</a></b></td>
                        <td>{{ $row->emp_fname ." ". $row->emp_mname ." ". $row->emp_lname }}</td>
                        <td>{{ $row->emp_email }}</td>
                        <td>{{ $row->emp_phone }}</td>
                        @if ($row->emp_dob == null)
                            <td class="text-danger">not avaliable</td>
                        @else
                            <td>{{ date('d/m/Y', strtotime($row->emp_dob)) }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection