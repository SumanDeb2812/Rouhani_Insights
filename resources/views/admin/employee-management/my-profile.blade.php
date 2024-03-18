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
            <a class="admin-side-menu-button active-dash-btn" href="my-profile"><i class="fa fa-user" style="margin-right: 10px;"></i> My Profile</a>
            <a class="admin-side-menu-button" href="manage-profile"><i class="fa fa-pencil" style="margin-right: 10px;"></i> Manage Profile</a>
            <a class="admin-side-menu-button" href="reset-password"><i class="fa fa-key" style="margin-right: 10px;"></i> Reset Password</a>
        </div>
    </div>
    <h3>My Profile</h3>
    <div class="employee-info-main-div">
        @isset($result)
        @foreach ($result as $row)
        <div class="employee-info-div">
            <div class="hab-content">
                <div class="emp-profile">
                    <div class="profile-img">
                        @if ($row->emp_image !=null)
                        <img src="{{ asset('storage/profile-image/'.$row->emp_image) }}" alt="" srcset="">
                        @else
                        <img src="{{ asset('storage/profile-image/deafult.webp') }}" alt="" srcset="">
                        @endif
                    </div>
                    <div class="emp-detail">
                        <p class="m-0"><b>{{ $row->emp_fname.' '.$row->emp_mname.' '.$row->emp_lname }}</b></p>
                        <span class="badge bg-primary mb-3">Employee</span>
                        <div class="emp-deatil-sub">
                            <p>Employee Id</p>
                            <p><b>{{ $row->emp_id }}</b></p>
                        </div>
                        <div class="emp-deatil-sub">
                            <p>Joining Date</p>
                            <p><b>{{ date('d.m.Y', strtotime($row->emp_join_date)) }}</b></p>
                        </div>
                        <div class="emp-deatil-sub">
                            <p>Designation</p>
                            <p><b>{{ $row->emp_desg }}</b></p>
                        </div>
                    </div>
                </div>
                <div class="emp-information">
                    <div class="emp-info-section">
                        <p id="emp_info_pi" class="emp_info_active emp_info_button" onclick="openPi()">Personal Details</p>
                        <p id="emp_info_qf" class="emp_info_active emp_info_button" onclick="openQf()">Qualification</p>
                        <p id="emp_info_we" class="emp_info_active emp_info_button" onclick="openWe()">Work Experience</p>
                        <p id="emp_info_bd" class="emp_info_active emp_info_button" onclick="openBd()">Bank Details</p>
                    </div>
                    <!-----------------------------personal details----------------------------------->
                    <div id="emp-info-sub-pi">
                        <h5 class="mb-3"><b>Personal Information</b></h5>
                        <div class="emp-deatil-sub">
                            <p>Full Name</p>
                            <p><b>{{ $row->emp_fname.' '.$row->emp_mname.' '.$row->emp_lname }}</b></p>
                        </div>
                        <div class="emp-detail-sub-div">
                            <div class="emp-deatil-sub">
                                <p>Birthdate</p>
                                <p><b>{{ date('d.m.Y', strtotime($row->emp_dob)) }}</b></p>
                            </div>
                            @if ($row->emp_marital != null)
                            <div class="emp-deatil-sub-1">
                                <p>Marital Status</p>
                                <p><b>{{ $row->emp_marital }}</b></p>   
                            </div>
                            @endif
                        </div>
                        <div class="emp-detail-sub-div">
                            @if ($row->emp_father != null)
                            <div class="emp-deatil-sub">
                                <p>Father Name</p>
                                <p><b>{{ $row->emp_father }}</b></p>
                            </div>
                            @endif
                            @if ($row->emp_mother != null)
                            <div class="emp-deatil-sub-1">
                                <p>Mother Name</p>
                                <p><b>{{ $row->emp_mother }}</b></p>
                            </div>
                            @endif
                        </div>
                        @if ($row->emp_dependent != null)
                        <div class="emp-deatil-sub">
                            <table>
                                <thead>
                                    <tr>
                                        <td>Dependent Name</td>
                                        <td>Relationship</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>
                                            @php
                                            $a = explode(',', $row->emp_dependent);
                                            foreach ($a as $b){
                                            echo "<li> {$b} </li>";
                                            }
                                            @endphp
                                        </b></td>
                                        <td><b>
                                            @php
                                            $a = explode(',', $row->dep_relation);
                                            foreach ($a as $b){
                                            echo "<li> {$b} </li>";
                                            }
                                            @endphp
                                        </b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @endif
                        @if ($row->emp_gurdian != null)
                        <div class="emp-deatil-sub">
                            <p>Gurdian Name</p>
                            <p><b>{{ $row->emp_gurdian }}</b></p>
                        </div>
                        @endif
                        <h5 class="mb-3"><b>Contact Details</b></h5>
                        <div class="emp-detail-sub-div">
                            <div class="emp-deatil-sub">
                                <p>Phone No.</p>
                                <p><b>{{ $row->emp_phone }}</b></p>
                            </div>
                            <div class="emp-deatil-sub-1">
                                <p>Email Address</p>
                                <p><b>{{ $row->emp_email }}</b></p>
                            </div>
                        </div>
                        @if ($row->emp_add_pin != null)
                        <div class="emp-deatil-sub">
                            <p>Address</p>
                            <p><b>{{ $row->emp_add_hno.', '.$row->emp_add_area.', '.$row->emp_add_city.', '.$row->emp_add_dist.', '.$row->emp_add_state.', '.$row->emp_add_cou.' - '.$row->emp_add_pin }}</b></p>
                        </div>
                        @endif
                    </div>
                    <!-----------------------------Qualification-------------------------------------->
                    <div id="emp-info-sub-qf">
                        <h5 class="mb-3"><b>Educational Details</b></h5>
                        @if(isset($qualification))
                            @foreach ($qualification as $row1)
                            @if ($row1->secondary_score != null)
                            <div class="emp-detail-sub-div-qul">
                                <div class="emp-deatil-sub-qul-1">
                                    <p>Secondary Marks</p>
                                    <p><b>{{ $row1->secondary_score }} %</b></p>
                                </div>
                                <div class="emp-deatil-sub-qul-1">
                                    <p>Year of passing</p>
                                    <p><b>{{ date('d-M-Y', strtotime($row1->s_passing_year)) }}</b></p>
                                </div>
                            </div>
                            <div class="emp-deatil-sub-qul">
                                <p>Secondary School</p>
                                <p><b>{{ $row1->secondary_school }}</b></p>
                            </div>
                            @endif
                            @if ($row1->hs_score != null) 
                            <div class="emp-detail-sub-div-qul">
                                <div class="emp-deatil-sub-qul-1">
                                    <p>High Secondary Marks</p>
                                    <p><b>{{ $row1->hs_score }} %</b></p>
                                </div>
                                <div class="emp-deatil-sub-qul-1">
                                    <p>Year of passing</p>
                                    <p><b>{{ date('d-M-Y', strtotime($row1->hs_passing_year)) }}</b></p>
                                </div>
                            </div>
                            <div class="emp-deatil-sub-qul">
                                <p>High Secondary School</p>
                                <p><b>{{ $row1->hs_school }}</b></p>
                            </div>
                            @endif
                            @if ($row1->diploma_score!= null)
                            <div class="emp-detail-sub-div-qul">
                                <div class="emp-deatil-sub-qul-1">
                                    <p>Diploma Marks</p>
                                    <p><b>{{ $row1->diploma_score }}%</b></p>
                                </div>
                                <div class="emp-deatil-sub-qul-1">
                                    <p>Year of passing</p>
                                    <p><b> {{ date('d-M-Y', strtotime($row1->diploma_year )) }}</b></p>
                                </div>
                            </div>
                            <div class="emp-deatil-sub-qul">
                                <p>Diploma College</p>
                                <p><b>{{ $row1->diploma_college }}</b></p>
                            </div>
                            @endif
                            @if ($row1->graduation_score != null)
                            <div class="emp-detail-sub-div-qul">
                                <div class="emp-deatil-sub-qul-1">
                                    <p>Graduation Marks</p>
                                    <p><b>{{ $row1->graduation_score }}%</b></p>
                                </div>
                                <div class="emp-deatil-sub-qul-1">
                                    <p>Year of passing</p>
                                    <p><b>{{ date('d-M-Y', strtotime($row1->graduation_year)) }}</b></p>
                                </div>
                            </div>
                            <div class="emp-deatil-sub-qul">
                                <p>Graduation University</p>
                                <p><b>{{ $row1->graduation_university }}</b></p>
                            </div>
                            @endif
                            @if ($row1->post_grd_score != null)
                            <div class="emp-detail-sub-div-qul">
                                <div class="emp-deatil-sub-qul-1">
                                    <p>Post-Graduation Marks</p>
                                    <p><b>{{ $row1->post_grd_score }}%</b></p>
                                </div>
                                <div class="emp-deatil-sub-qul-1">
                                    <p>Year of passing</p>
                                    <p><b>{{ date('d-M-Y', strtotime($row1->post_grd_year)) }}</b></p>
                                </div>
                            </div>
                            <div class="emp-deatil-sub-qul">
                                <p>Post-Graduation University</p>
                                <p><b>{{ $row1->post_grd_university }}</b></p>
                            </div>
                            @endif
                            @if ($row1->high_qul_name != null)
                            <div class="emp-deatil-sub-qul-single">
                                <p>Highest Qualification</p>
                                <p><b>{{ $row1->high_qul_name }}</b></p>
                            </div>
                            @endif
                            @if ($row1->extra_course != null or $row1->certification != null)
                            <h5 class="mb-3"><b>Other Details</b></h5>
                            @if ($row1->extra_course != null)
                            <div class="emp-deatil-sub-qul-single">
                                <p>Extra Courses</p>
                                <p><b>{{ $row1->extra_course }}</b></p>
                            </div>
                            @endif
                            @if ($row1->certification != null)
                            <div class="emp-deatil-sub-qul-single">
                                <p>Certification</p>
                                <p><b>{{ $row1->certification }}</b></p>
                            </div>
                            @endif
                            @endif
                            @endforeach
                        @else
                        <p>No Details Found</p>
                        @endif
                    </div>
                    <!-----------------------------Work Experience------------------------------------->
                    <div id="emp-info-sub-we">
                        <h5 class="mb-3"><b>Work Experience</b></h5>
                        @if (isset($experience))
                            @foreach ($experience as $row2)
                            <div class="emp-detail-sub-div">
                                @if ($row2->past_cname != null)
                                <div class="emp-deatil-sub">
                                    <p>Previous Company Name</p>
                                    <p><b>{{ $row2->past_cname }}</b></p>
                                </div>
                                @endif
                                @if ($row2->past_desg != null)
                                <div class="emp-deatil-sub-1">
                                    <p>Designation</p>
                                    <p><b>{{ $row2->past_desg }}</b></p>
                                </div>
                                @endif
                            </div>
                            <div class="emp-detail-sub-div">
                                @if ($row2->past_join_date != null)
                                <div class="emp-deatil-sub">
                                    <p>Joining Date</p>
                                    <p><b>{{ date('d-M-Y', strtotime($row2->past_join_date)) }}</b></p>
                                </div>
                                @endif
                                @if ($row2->past_left_date != null)
                                <div class="emp-deatil-sub-1">
                                    <p>Leaving Date</p>
                                    <p><b>{{ date('d-M-Y', strtotime($row2->past_left_date)) }}</b></p>
                                </div>
                                @endif
                                <?php
                                // }
                                ?>
                            </div>
                            <div class="emp-detail-sub-div">
                                @if ($row2->paper_published != null)
                                <div class="emp-deatil-sub">
                                    <p>Paper Published</p>
                                    <p><b>{{ $row2->paper_published}}</b></p>
                                </div>
                                @endif
                                @if ($row2->conf_deatils != null)
                                <div class="emp-deatil-sub-1">
                                    <p>Publication</p>
                                    <p><b>{{ $row2->conf_deatils }}</b></p>
                                </div>
                                @endif
                            </div>
                            @if ($row2->emp_skills != null)
                            <div class="emp-deatil-sub-qul-single">
                                <p>Skills</p>
                                <td><b>
                                @php
                                $e = explode(',', $row2->emp_skills);
                                foreach ($e as $f){ echo "<li>{$f}</li>"; }
                                @endphp
                                </b></td>
                            </div>
                            @endif
                            @endforeach
                        @else
                            <p>No details found</p>
                        @endif
                    </div>
                    <!-----------------------------Work Experience------------------------------------->
                    <div id="emp-info-sub-bd">
                        <h5 class="mb-3"><b>Bank Details</b></h5>
                        @if (isset($bank))
                            @foreach ($bank as $row3)
                            @if ($row3->emp_bank_ifsc != null)
                            <div class="emp-detail-sub-div">
                                <div class="emp-deatil-sub">
                                    <p>Bank Name</p>
                                    <p><b>{{ $row3->emp_bank_name }}</b></p>
                                </div>
                                <div class="emp-deatil-sub-1">
                                    <p>Account No.</p>
                                    <p><b>{{ $row3->emp_acc_no }}</b></p>
                                </div>
                            </div>
                            <div class="emp-detail-sub-div">
                                <div class="emp-deatil-sub">
                                    <p>IFSC Code</p>
                                    <p><b>{{ $row3->emp_bank_ifsc }}</b></p>
                                </div>
                            </div>
                            <div class="emp-detail-sub-div">
                                <div class="emp-deatil-sub">
                                    <p>Branch Name</p>
                                    <p><b>{{ $row3->emp_bank_branch }}</b></p>
                                </div>
                                <div class="emp-deatil-sub-1">
                                    <p>Account Type</p>
                                    <p><b>{{ $row3->emp_acc_type }}</b></p>
                                </div>
                            </div>
                            <div class="emp-deatil-sub-qul-single">
                                <p>Bank Address</p>
                                <p><b>{{ $row3->emp_bank_address }}</b></p>
                            </div>
                            @endif
                            @endforeach
                        @else
                            <p>No details found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endisset
    </div>
</div>

<script src="{{ asset('admin/js/employee-deatils-form.js') }}"></script>
@endsection