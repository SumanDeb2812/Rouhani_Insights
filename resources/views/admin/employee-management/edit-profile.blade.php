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
            <a class="admin-side-menu-button active-dash-btn" href="manage-profile"><i class="fa fa-pencil" style="margin-right: 10px;"></i> Manage Profile</a>
            <a class="admin-side-menu-button" href="reset-password"><i class="fa fa-key" style="margin-right: 10px;"></i> Reset Password</a>
        </div>
    </div>
    <h3><i class="fa fa-pencil" style="margin-right: 10px;"></i>Manage Your Profile</h3>
    <div class="manage-profile-main-div">
        <div class="emp-info-section-ep">
            <p id="emp_info_pi" class="emp_info_active emp_info_button" onclick="openPi()">Personal Details</p>
            <p id="emp_info_qf" class="emp_info_active emp_info_button" onclick="openQf()">Qualification</p>
            <p id="emp_info_we" class="emp_info_active emp_info_button" onclick="openWe()">Work Experience</p>
            <p id="emp_info_bd" class="emp_info_active emp_info_button" onclick="openBd()">Bank Details</p>
            <p id="emp_info_dp" class="emp_info_active emp_info_button" onclick="openDp()">Profile Image</p>
        </div>
    <!----------------------------------------Personal Details-------------------------------------------->
    <div class="employee-list-table-ep" id="emp-info-sub-ep-pi">
        <div class="add-employee-form-box">
            @foreach ($result as $row)
            <form action="{{ route('employee.updatePersonalDetails') }}" method="post" enctype="multipart/form-data" id="submit-personal-details">
                @csrf
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Father Name</label>
                        <input type="text" name="emp_father" id="emp-father" value="{{ $row->emp_father }}">
                        <p class="employee-details-form-error" id="emp-father-error"></p>
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Mother Name</label>
                        <input type="text" name="emp_mother" id="emp-mother" value="{{ $row->emp_mother }}">
                        <p class="employee-details-form-error" id="emp-mother-error"></p>
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Gurdian Name</label>
                        <input type="text" name="emp_gurdian" id="emp-gurdian" value="{{ $row->emp_gurdian }}">
                        <p class="employee-details-form-error" id="emp-gurdian-error"></p>
                    </div>
                </div>
                <div class="add-employee-form-div-clone-div">
                    <div class="d-flex align-items-end">
                        <div class="add-employee-form-sub-div" id="cloneDiv_1">
                            <label class="">Dependent Name</label>
                            @php
                            if ($row->emp_dependent != null){
                                $a = explode(',', $row->emp_dependent);
                                foreach ($a as $b){
                                echo '<input type="text" name="emp_dependent[]" id="oriClone_1" value="'.$b.'">';
                                }
                            }else{
                                echo '<input type="text" id="oriClone_1" name="emp_dependent[]">';
                            }
                            @endphp
                            <p class="employee-details-form-error" id="emp-ori-1-error" style="margin-top: 0"></p>
                        </div>
                        <div class="add-employee-form-sub-div" id="cloneDiv_2">
                            <label for="">Relation with the dependent</label>
                            @php
                            if ($row->dep_relation != null){
                                $c = explode(',', $row->dep_relation);
                                foreach ($c as $d){
                                echo '<select name="dep_relation[]" id="oriClone_2">';
                                    if ($d == null) {
                                    echo '<option value="" selected>Select one</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Spouse">Spouse</option>';
                                    } elseif ($d == 'Father') {
                                    echo '<option value="">Select one</option>
                                        <option value="Father" selected>Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Spouse">Spouse</option>';
                                    } elseif ($d == 'Mother') {
                                    echo '<option value="">Select one</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother" selected>Mother</option>
                                        <option value="Spouse">Spouse</option>';
                                    } else {
                                    echo '<option value="">Select one</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Spouse" selected>Spouse</option>';
                                    }
                                    echo '</select>';
                                }
                            }else{
                                echo '<select name="dep_relation[]" id="oriClone_2">
                                        <option value="" selected>Select one</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Spouse">Spouse</option>
                                    </select>';
                            }
                            @endphp
                            <p class="employee-details-form-error" id="emp-ori-2-error" style="margin-top: 0"></p>
                        </div>
                        <div class="add-employee-form-sub-div" id="cloneDiv_3">
                            <button onclick="removeClone()" style="display: none;" id="remove_clone">Remove</button>
                        </div>
                    </div>
                    <div class="add-employee-clone-btn-set">
                        <button onclick="makeClone()" id="clone-dependent" disabled>Add</button>
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Maratial Status</label>
                        <select name="emp_marital" id="emp-marital">
                        @php
                        if ($row->emp_marital == null) {
                            echo '<option value="" selected>Select one</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>';
                        } elseif ($row->emp_marital == 'Single') {
                            echo '<option>Select one</option>
                                <option value="Single" selected>Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>';
                        } elseif ($row->emp_marital == 'Married') {
                            echo '<option>Select one</option>
                                <option value="Single">Single</option>
                                <option value="Married" selected>Married</option>
                                <option value="Widowed">Widowed</option>';
                        } else {
                            echo '<option>Select one</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed" selected>Widowed</option>';
                        }
                        @endphp
                        </select>
                        <p class="employee-details-form-error" id="emp-marital-error"></p>
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Nationality</label>
                        <select name="emp_nationality" id="emp-nationality">
                        @php
                        if ($row->emp_nationality == null) {
                            echo '<option value="" selected>Select one</option>
                                <option value="Indian">Indian</option>
                                <option value="Other">Other</option>';
                        } elseif ($row->emp_nationality == 'Indian') {
                            echo '<option selected>Select one</option>
                                <option value="Indian" selected>Indian</option>
                                <option value="Other">Other</option>';
                        } else {
                            echo '<option selected>Select one</option>
                                <option value="Indian">Indian</option>
                                <option value="Other" selected>Other</option>';
                        }
                        @endphp
                        </select>
                        <p class="employee-details-form-error" id="emp-nationality-error"></p>
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Religion</label>
                        <input type="text" name="emp_religion" id="emp-religion" value="{{ $row->emp_religion }}">
                        <p class="employee-details-form-error" id="emp-religion-error"></p>
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div-1">
                        <div class="add-employee-form-sub-div">
                            <label for="">Pincode</label>
                            <input type="text" name="emp_add_pin" id="pincode" value="{{ $row->emp_add_pin }}">
                        </div>
                        <span class="gen_pass_btn" onclick="searchPincode()">Search</span>
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">House No.</label>
                        <input type="text" name="emp_add_hno" id="emp_add_hno" value="{{ $row->emp_add_hno }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Area / Locality</label>
                        <input type="text" name="emp_add_area" id="emp_desg" value="{{ $row->emp_add_area }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">City</label>
                        @if ($row->emp_add_city == null)
                        <select name="emp_add_city" id="city-name"></select>
                        @else
                        <select name="emp_add_city" id="city-name">
                            <option value="{{ $row->emp_add_city }}">{{ $row->emp_add_city }}</option>
                        </select>
                        @endif
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">District</label>
                        <input type="text" name="emp_add_dist" id="district" value="{{ $row->emp_add_dist }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">State</label>
                        <input type="text" name="emp_add_state" id="state" value="{{ $row->emp_add_state }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Country</label>
                        <input type="text" name="emp_add_cou" id="country" value="{{ $row->emp_add_cou }}">
                    </div>
                </div>
                <div class="add-employee-form-div d-flex justify-content-center">
                    <button type="submit" class="add-employee-btn">Update Personal Details</button>
                </div>
            </form>
            @endforeach
        </div>
    </div>
    <!---------------------------------------- Qulification ----------------------------------------------->
    <div class="employee-list-table-ep" id="emp-info-sub-ep-qf">
        <div class="add-employee-form-box">
            @foreach ($qualification as $row2)
            <form action="{{ route('employee.updateQualification') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Secondary Marks</label>
                        <input type="text" name="secondary_score" id="" value="{{ $row2->secondary_score }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Secondary School</label>
                        <input type="text" name="secondary_school" id="" value="{{ $row2->secondary_school }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Year of Passing</label>
                        <input type="date" name="s_passing_year" id="" value="{{ $row2->s_passing_year }}">
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">High Secondary Marks</label>
                        <input type="text" name="hs_score" id="" value="{{ $row2->hs_score }} ">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">High Secondary School</label>
                        <input type="text" name="hs_school" id="" value="{{ $row2->hs_school }} ">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Year of Passing</label>
                        <input type="date" name="hs_passing_year" id="" value="{{ $row2->hs_passing_year }} ">
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Diploma Marks</label>
                        <input type="text" name="diploma_score" id="" value="{{ $row2->diploma_score }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Diploma College</label>
                        <input type="text" name="diploma_college" id="" value="{{ $row2->diploma_college }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Year of Passing</label>
                        <input type="date" name="diploma_year" id="" value="{{ $row2->diploma_year }}">
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Graduation Marks</label>
                        <input type="text" name="graduation_score" id="" value="{{ $row2->graduation_score }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Graduation University</label>
                        <input type="text" name="graduation_university" id="" value="{{ $row2->graduation_university }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Year of Passing</label>
                        <input type="date" name="graduation_year" id="" value="{{ $row2->graduation_year }}">
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Post-Graduation Marks</label>
                        <input type="text" name="post_grd_score" id="" value="{{ $row2->post_grd_score }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Post-Graduation University</label>
                        <input type="text" name="post_grd_university" id="" value="{{ $row2->post_grd_university }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Year of Passing</label>
                        <input type="date" name="post_grd_year" id="" value="{{ $row2->post_grd_year }}">
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Highest Qualification</label>
                        <input type="text" name="high_qul_name" id="" value="{{ $row2->high_qul_name }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Extra Courses (If Any)</label>
                        <input type="text" name="extra_course" id="" value="{{ $row2->extra_course }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Certification (If Any)</label>
                        <input type="text" name="certification" id="" value="{{ $row2->certification }}">
                    </div>
                </div>
                <div class="add-employee-form-div d-flex justify-content-center">
                    <button type="submit" class="add-employee-btn">Update Qualification</button>
                </div>
            </form>
            @endforeach
        </div>
    </div>
    <!------------------------------------- Work Experience ----------------------------------------------->
    <div class="employee-list-table-ep" id="emp-info-sub-ep-we">
        <div class="add-employee-form-box">
            @foreach ($experience as $row4)
            <form action="{{ route('employee.updateWorkExperience') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Previous Company Name</label>
                        <input type="text" name="past_cname" id="" value="{{ $row4->past_cname }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Previous Company Desgnation</label>
                        <input type="text" name="past_desg" id="" value="{{ $row4->past_desg }}">
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Previous Company Joining Date</label>
                        <input type="date" name="past_join_date" id="" value="{{ $row4->past_join_date }}">
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Previous Company Left Date</label>
                        <input type="date" name="past_left_date" id="" value="{{ $row4->past_left_date }}">
                    </div>
                </div>
                <div class="add-employee-form-div-skill-clone-div">
                    <div class="d-flex align-items-end">
                        <div class="add-employee-form-sub-div" id="cloneDiv_Skill">
                            <label>Skills</label>
                            @php
                            if ($row4->emp_skills != null) {
                                $e = explode(',', $row4->emp_skills);
                                foreach ($e as $f) {
                                echo '<input type="text" name="emp_skills[]" id="oriClone_Skill" value="'.$f.'">';
                                }
                            }else{
                                echo '<input type="text" id="oriClone_Skill" name="emp_skills[]">';
                            }
                            @endphp
                        </div>
                        <div class="add-employee-form-sub-div" id="cloneDiv_Skill_Remove">
                            <button onclick="removeSkillClone()" style="display: none;" id="remove_clone_skill">Remove</button>
                        </div>
                    </div>
                    <div class="add-employee-clone-btn-set">
                        <button onclick="makeSkillClone()">Add Skills</button>
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Paper Published (If Any)</label>
                        <textarea type="text" name="paper_published" id="" rows="5">{{ $row4->paper_published }}</textarea>
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Publication</label>
                        <select name="conf_deatils">
                        @php
                        if ($row4->conf_deatils == null) {
                            echo '<option selected>Select one</option>
                                <option value="Journal">Journal</option>
                                <option value="Conference">Conference</option>';
                        } elseif ($row4->conf_deatils == 'Journal') {
                            echo '<option selected>Select one</option>
                                <option value="Journal" selected>Journal</option>
                                <option value="Conference">Conference</option>';
                        } else {
                            echo '<option selected>Select one</option>
                                <option value="Journal">Journal</option>
                                <option value="Conference" selected>Conference</option>';
                        }
                        @endphp
                        </select>
                    </div>
                </div>
                <div class="add-employee-form-div d-flex justify-content-center">
                    <button type="submit" class="add-employee-btn">Update Work Experience</button>
                </div>
            </form>
            @endforeach
        </div>
    </div>
    <!-------------------------------------- Bank Details ------------------------------------------------->
    <div class="employee-list-table-ep" id="emp-info-sub-ep-bd">
        @if (isset($bank))
       <div class="add-employee-form-box">
            @foreach ($bank as $row3)
           <form action="{{ route('employee.updateBankDetails') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div-1">
                        <div class="add-employee-form-sub-div">
                            <label for="">IFSC Code</label>
                            <input type="text" name="emp_bank_ifsc" id="emp_bank_ifsc" value="{{ $row3->emp_bank_ifsc}}">
                        </div>
                        <span class="gen_pass_btn" onclick="searchIFSC()">Search</span>
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div-1">
                        <div class="add-employee-form-sub-div">
                            <label for="">Account No.</label>
                            <input type="text" name="emp_acc_no" id="emp_acc_no" value="{{ $row3->emp_acc_no }} ">
                        </div>
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Bank Name</label>
                        <input type="text" name="emp_bank_name" id="emp_bank_name" value="{{ $row3->emp_bank_name }}">
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div">
                        <label for="">Bank Address</label>
                        <input type="text" name="emp_bank_address" id="emp_bank_address" value="{{ $row3->emp_bank_address }}" style="width: 68.5vw;">
                    </div>
                </div>
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div-1">
                        <div class="add-employee-form-sub-div">
                            <label for="">Bank Branch Name</label>
                            <input type="text" name="emp_bank_branch" id="emp_bank_branch" value="{{ $row3->emp_bank_branch }}">
                        </div>
                    </div>
                    <div class="add-employee-form-sub-div">
                        <label for="">Account Type</label>
                        <select name="emp_acc_type">
                            @php
                            if ($row3->emp_acc_type == null) {
                                echo '<option selected>Select one</option>
                                    <option value="Savings">Savings</option>
                                    <option value="Current">Current</option>';
                            } elseif ($row3->emp_acc_type == 'Savings') {
                                echo '<option selected>Select one</option>
                                    <option value="Savings" selected>Savings</option>
                                    <option value="Current">Current</option>';
                            } else {
                                echo '<option selected>Select one</option>
                                    <option value="Savings">Savings</option>
                                    <option value="Current" selected>Current</option>';
                            }
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="add-employee-form-div d-flex justify-content-center">
                    <button type="submit" class="add-employee-btn">Update Bank Details</button>
                </div>
            </form>
            @endforeach
        </div> 
        @endif
    </div>
    <!---------------------------------------Profile Image------------------------------------------------->
    <div class="employee-list-table-ep" id="emp-info-sub-ep-dp">
       <div class="add-employee-form-box">
            @foreach ($result as $row5)
           <form action="{{ route('employee.updateProfileImage') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="add-employee-form-div">
                    <div class="add-employee-form-sub-div-1" style="flex-direction: column; align-items: start">
                        <input type="file" name="emp_image" id="">
                        @error('emp_image')
                            <p style="color: red; margin-top: 10px; font-weight: 600; font-size: 14px">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="add-employee-form-sub-div-image">
                        @if ($row5->emp_image !=null)
                        <img src="{{ asset('storage/profile-image/'.$row5->emp_image) }}" alt="" srcset="">
                        @else
                        <img src="{{ asset('storage/profile-image/deafult.webp') }}" alt="" srcset="">
                        @endif
                    </div>
                </div>
                <div class="add-employee-form-div d-flex justify-content-center">
                    <button type="submit" class="add-employee-btn">Update Profile Image</button>
                </div>
            </form>
            @endforeach
        </div> 
    </div>
</div>

<script src="{{ asset('admin/js/employee-deatils-edit.js') }}"></script>
@endsection