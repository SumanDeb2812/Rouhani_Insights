@extends('admin.layout.lavel-1-layout')

@section('main-content')
<div class="admin-header">
    <div class="admin-header-sub">
        <img src="{{ asset('website/images/logo2.png') }}" alt="">
        <div class="dashboard-user">
            <div class="show-role">
            @if(session()->get('active_role') == 1) <p style="color: Red">A</p>
            @elseif (session()->get('active_role') == 2) <p style="color: Green">M</p>
            @elseif (session()->get('active_role') == 3) <p style="color: Blue">E</p>
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
    <h2><i class="fa fa-lock"></i> Authorization</h2>
    <div class="admin-table-content">
        <div class="assign-role-form-div">
            <h5>Assign Role</h5>
            <form action="{{ route('assign.role') }}" method="post">
                @csrf
                <div class="input-box">
                    <label for="">Employee</label>
                    <select name="emp_id" id="">
                        <option value="">Choose one</option>
                        @foreach ($emp as $e)
                        <option value="{{ $e->emp_id }}">{{ $e->emp_id . '/' . $e->emp_fname . ' ' . $e->emp_lname}}</option>
                        @endforeach
                    </select>
                    @error('emp_id')
                        <div class="role-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-box">
                    <label for="">Role</label>
                    <select name="role_id" id="authorization-role">
                        <option value="">Choose one</option>
                        @foreach ($role as $r)
                        <option value="{{ $r->role_id }}">{{ $r->role_name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <div class="role-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-box" style="display: none" id="authorization-emp-select">
                    <label for="">Authorize</label>
                    <select name="" id="authorization-emp-list">
                        <option value="">Choose one</option>
                        @foreach ($emp as $e)
                        <option value="{{ $e->emp_id }}">{{ $e->emp_id . '/' . $e->emp_fname . ' ' . $e->emp_lname}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="Assign" id="assign-role-btn">
            </form>
            <div id="show-authorized-emp"></div>
            @error('au_emp_id')
            <div class="role-error">{{ $message }}</div>
            @enderror
            @error('role_error')
                <div class="role-error">{{ $message }}</div>
            @enderror
            @if(session()->has('success'))
                <div class="role-success">{{ session()->get('success') }}</div>
            @endif
        </div>    
        <div class="assign-role-table-div">
            <h5>Remove Role</h5>
            <form action="" method="post">
                <div class="input-box">
                    <label for="">Employee</label>
                    <select name="" id="role-auth-empid">
                        <option value="">Select Employee</option>
                        @foreach ($auth as $a)
                        <option value="{{ $a->emp_id }}">{{ $a->emp_id }}/ {{ $a->emp_fname }} {{ $a->emp_lname }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-box">
                    <label for="">Role</label>
                    <select name="" id="role-auth-roleid">
                        <option value="">Select Role</option>
                    </select>
                </div>
                <input type="submit" id="remove-role-btn" value="Remove">
            </form>
            {{-- @error('role_error')
                <div class="role-error">{{ $message }}</div>
            @enderror
            @if(session()->has('success'))
                <div class="role-success">{{ session()->get('success') }}</div>
            @endif --}}
        </div>
    </div>
</div>
@endsection