<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    public function index()
    {
        if(session()->get('active_role') == 1){
            $result = DB::table('hrd_emp_deatils')
                        ->get();
        }
        return view('admin.employee-management.employee', ['result' => $result]);
    }

    public function indexAddEmployee()
    {
        return view('admin.employee-management.add-employee');
    }

    public function addNewEmployee(Request $request)
    {
        $validate = $request->validate([
                                'emp_fname' => 'required',
                                'emp_lname' => 'required',
                                'emp_id' => 'required|unique:hrd_emp_deatils,emp_id',
                                'emp_dob' => 'required',
                                'emp_phone' => 'required',
                                'emp_email' => 'required|email',
                                'emp_desg' => 'required',
                                'emp_join_date' => 'required',
                            ]);
        if($validate == true){
            $emp_fname = $request->get('emp_fname');
            $emp_mname = $request->get('emp_mname');
            $emp_lname = $request->get('emp_lname');
            $emp_id = $request->get('emp_id');
            $emp_dob =$request->get('emp_dob');
            $emp_phone = $request->get('emp_phone');
            $emp_desg = $request->get('emp_desg');
            $emp_join_date = $request->get('emp_join_date');
            $emp_email = $request->get('emp_email');
            $emp_password = md5($request->get('emp_password'));
            $emp_pass_nonhash = $request->get('emp_password');

            $result = DB::table('hrd_emp_deatils')
                        ->insert([
                            'emp_fname' => $emp_fname,
                            'emp_mname' => $emp_mname,
                            'emp_lname' => $emp_lname,
                            'emp_id' => $emp_id,
                            'emp_dob' => $emp_dob,
                            'emp_phone' => $emp_phone,
                            'emp_email' => $emp_email,
                            'emp_desg' => $emp_desg,
                            'emp_join_date' => $emp_join_date,
                            'emp_password' => $emp_password
                        ]);
            $data = [
                'name' => $emp_fname." ".$emp_mname." ".$emp_lname,
                'password' => $emp_pass_nonhash,
                'emp_id' => $emp_id
            ];
            if($result == true){
                DB::table('hrd_emp_qul')
                    ->insert([
                        'emp_id' => $emp_id
                    ]);
                DB::table('hrd_emp_we')
                    ->insert([
                        'emp_id' => $emp_id
                    ]);
                DB::table('hrd_emp_bd')
                    ->insert([
                        'emp_id' => $emp_id
                    ]);
                session()->put(['success-alert' => 'New employee added successfully']);
                Mail::to($emp_email, $emp_fname." ".$emp_mname." ".$emp_lname)->send(new WelcomeMail($data));
                return redirect()->back();
            }
        }
    }

    public function indexSetPassword()
    {
        return view('admin.employee-management.set-password');
    }

    public function setPassword(Request $request)
    {
        $validate = $request->validate([
            'emp_new_password' => 'required',
            'emp_new_con_password' => 'required'
        ]);
        if($validate == true){
            $emp_id = $request->emp_id;
            $emp_new_password = md5($request->emp_new_password);
            $result = DB::table('hrd_emp_deatils')
                        ->where('emp_id', $emp_id)
                        ->get();
            if($result[0]->emp_password === $emp_new_password){
                return redirect()->back()->withErrors(['set-password-error' => 'Can not set same system generate password']);
            }else{
                $result1 = DB::table('hrd_emp_deatils')
                            ->where('emp_id', $emp_id)
                            ->update([
                                'emp_password' => $emp_new_password,
                                'first_time_login' => 1
                            ]);
                $result2 = DB::table('wb_emp_auth')
                    ->insert([
                        'emp_id' => $emp_id,
                        'role_id' => 3,
                    ]);
                if($result1 == true and $result2 == true){
                    return redirect('login')->with(['change_password_success' => 'Password chnaged successfully']);
                }else{
                    return redirect()->back()->withErrors(['set-password-error' => 'Internal server error']);
                }
            }
                    
        }
    }

    public function indexMyProfile()
    {
        $result = DB::table('hrd_emp_deatils')
                    ->where('emp_id', session()->get('emp_id'))
                    ->get();

        $result1 = DB::table('hrd_emp_qul')
                    ->where('emp_id', session()->get('emp_id'))
                    ->get();
        if($result1->has([0])){
            $qualification = $result1;
        }

        $result2 = DB::table('hrd_emp_we')
                    ->where('emp_id', session()->get('emp_id'))
                    ->get();
        if($result1->has([0])){
            $experience = $result2;
        }

        $result3 = DB::table('hrd_emp_bd')
                    ->where('emp_id', session()->get('emp_id'))
                    ->get();
        if($result3->has([0])){
            $bank = $result3;
        }

        return view('admin.employee-management.my-profile', ['result' => $result, 'qualification' => $qualification, 'experience' => $experience, 'bank' => $bank]);
    }

    public function indexManageProfile()
    {
        $result = DB::table('hrd_emp_deatils')
                    ->where('emp_id', session()->get('emp_id'))
                    ->get();

        $result1 = DB::table('hrd_emp_qul')
                    ->where('emp_id', session()->get('emp_id'))
                    ->get();
        $qualification = $result1;

        $result2 = DB::table('hrd_emp_we')
                    ->where('emp_id', session()->get('emp_id'))
                    ->get();
        $experience = $result2;

        $result3 = DB::table('hrd_emp_bd')
                    ->where('emp_id', session()->get('emp_id'))
                    ->get();
        $bank = $result3;

        return view('admin.employee-management.edit-profile', ['result' => $result, 'qualification' => $qualification, 'experience' => $experience, 'bank' => $bank]);
    }

    public function updatePersonalDetails(Request $request)
    {
        $emp_father = $request->get('emp_father');
        $emp_mother = $request->get('emp_mother');
        $emp_gurdian = $request->get('emp_gurdian');
        $arrA = implode(',', $request->get('emp_dependent'));
        $arrB = implode(',', $request->get('dep_relation'));
        $emp_dependent = $arrA;
        $dep_relation = $arrB;
        $emp_marital = $request->get('emp_marital');
        $emp_nationality = $request->get('emp_nationality');
        $emp_religion = $request->get('emp_religion');
        $emp_add_pin = $request->get('emp_add_pin');
        $emp_add_hno = $request->get('emp_add_hno');
        $emp_add_area = $request->get('emp_add_area');
        $emp_add_city = $request->get('emp_add_city');
        $emp_add_dist = $request->get('emp_add_dist');
        $emp_add_state = $request->get('emp_add_state');
        $emp_add_cou = $request->get('emp_add_cou');

        $result = DB::table('hrd_emp_deatils')
                    ->where('emp_id', session()->get('emp_id'))
                    ->update([
                        'emp_father' => $emp_father, 
                        'emp_mother' => $emp_mother,
                        'emp_gurdian' => $emp_gurdian, 
                        'emp_dependent' => $emp_dependent, 
                        'dep_relation' => $dep_relation, 
                        'emp_marital' => $emp_marital, 
                        'emp_nationality' => $emp_nationality, 
                        'emp_religion' => $emp_religion, 
                        'emp_add_pin' => $emp_add_pin, 
                        'emp_add_hno' => $emp_add_hno, 
                        'emp_add_area' => $emp_add_area, 
                        'emp_add_city' => $emp_add_city, 
                        'emp_add_dist' => $emp_add_dist, 
                        'emp_add_state' => $emp_add_state, 
                        'emp_add_cou' => $emp_add_cou
                    ]);
            if ($result == true) {
                return redirect()->back()->with(['success-alert' => 'Personal Details Updated Successfully']);
            } else {
                return redirect()->back()->withErrors(['failed-alert' => 'Failed to update details, Try again!']);
            }
    }

    public function updateQualification(Request $request)
    {
        $secondary_score = $request->get('secondary_score');
        $secondary_school = $request->get('secondary_school');
        $s_passing_year = $request->get('s_passing_year');
        $hs_score = $request->get('hs_score');
        $hs_school = $request->get('hs_school');
        $hs_passing_year = $request->get('hs_passing_year');
        $diploma_score = $request->get('diploma_score');
        $diploma_college = $request->get('diploma_college');
        $diploma_year = $request->get('diploma_year');
        $graduation_score = $request->get('graduation_score');
        $graduation_university = $request->get('graduation_university');
        $graduation_year = $request->get('graduation_year');
        $post_grd_score = $request->get('post_grd_score');
        $post_grd_university = $request->get('post_grd_university');
        $post_grd_year = $request->get('post_grd_year');
        $high_qul_name = $request->get('high_qul_name');
        $extra_course = $request->get('extra_course');
        $certification = $request->get('certification');

        $result = DB::table('hrd_emp_qul')
                    ->where('emp_id', session()->get('emp_id'))
                    -> update([
                        'secondary_score' => $secondary_score, 
                        'secondary_school' => $secondary_school, 
                        's_passing_year' => $s_passing_year, 
                        'hs_score' => $hs_score, 
                        'hs_school' => $hs_school, 
                        'hs_passing_year' => $hs_passing_year, 
                        'diploma_score' => $diploma_score,
                        'diploma_college' => $diploma_college, 
                        'diploma_year' => $diploma_year, 
                        'graduation_score' => $graduation_score, 
                        'graduation_university' => $graduation_university, 
                        'graduation_year' => $graduation_year, 
                        'post_grd_score' => $post_grd_score, 
                        'post_grd_university' => $post_grd_university, 
                        'post_grd_year' => $post_grd_year, 
                        'high_qul_name' => $high_qul_name, 
                        'extra_course' => $extra_course, 
                        'certification' => $certification
                    ]);
        if ($result == true) {
            return redirect()->back()->with(['success-alert' => 'Qualification Details Updated Successfully']);
        } else {
            return redirect()->back()->withErrors(['failed-alert' => 'Failed to update details, Try again!']);
        }
    }

    public function updateWorkExperience(Request $request)
    {
        $past_cname = $request->get('past_cname');
        $past_desg = $request->get('past_desg');
        $past_join_date = $request->get('past_join_date');
        $past_left_date = $request->get('past_left_date');
        $emp_skills = implode(',', $request->get('emp_skills'));
        $paper_published = $request->get('paper_published');
        $conf_deatils = $request->get('conf_deatils');
                
        $result = DB::table('hrd_emp_we')
                    ->where('emp_id', session()->get('emp_id'))
                    -> update([
                        'past_cname' => $past_cname, 
                        'past_desg' => $past_desg, 
                        'past_join_date' => $past_join_date, 
                        'past_left_date' => $past_left_date, 
                        'emp_skills' => $emp_skills, 
                        'paper_published' => $paper_published,
                        'conf_deatils' => $conf_deatils
                    ]);
        if ($result == true) {
            return redirect()->back()->with(['success-alert' => 'Work Experience Details Updated Successfully']);
        } else {
            return redirect()->back()->withErrors(['failed-alert' => 'Failed to update details, Try again!']);
        }
    }

    public function updateBankDetails(Request $request)
    {
        $emp_bank_ifsc = $request->get('emp_bank_ifsc');
        $emp_acc_no = $request->get('emp_acc_no');
        $emp_bank_name = $request->get('emp_bank_name');
        $emp_bank_address = $request->get('emp_bank_address');
        $emp_bank_branch = $request->get('emp_bank_branch');
        $emp_acc_type = $request->get('emp_acc_type');
                
        $result = DB::table('hrd_emp_bd')
                    ->where('emp_id', session()->get('emp_id'))
                    -> update([
                        'emp_bank_ifsc' => $emp_bank_ifsc, 
                        'emp_acc_no' => $emp_acc_no, 
                        'emp_bank_name' => $emp_bank_name, 
                        'emp_bank_address' => $emp_bank_address, 
                        'emp_bank_branch' => $emp_bank_branch, 
                        'emp_acc_type' => $emp_acc_type
                    ]);
        if ($result == true) {
            return redirect()->back()->with(['success-alert' => 'Bank Details Updated Successfully']);
        } else {
            return redirect()->back()->withErrors(['failed-alert' => 'Failed to update details, Try again!']);
        }
    }

    public function updateProfileImage(Request $request)
    {
        $validate = $request->validate([
            'emp_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if($validate == true){
            $imageName = session()->get('emp_id').'.'.$request->file('emp_image')->extension();
            $request->file('emp_image')->move(public_path('storage/profile-image'), $imageName);
            $result = DB::table('hrd_emp_deatils')
                        ->where('emp_id', session()->get('emp_id'))
                        ->update([
                            'emp_image' => $imageName
                        ]);
            if($result == true){
                return redirect()->back()->with(['success-alert' => 'Profile Image Updated Successfully']);
            }
        }
    }

    public function indexResetPassword()
    {
        return view('admin.employee-management.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $emp_old_password = md5($request->get('emp_old_password'));
        $result = DB::table('hrd_emp_deatils')
                    ->where('emp_id', session()->get('emp_id'))
                    ->where('emp_password', $emp_old_password)
                    ->get();
        if($result->has([0])){
            $emp_new_passowrd = md5($request->get('emp_new_passowrd'));
            if($emp_new_passowrd == $result[0]->emp_password){
                return redirect()->back()->withErrors(['password-reset-error' => 'Can not set same password twice']);
            }else{
                $result1 = DB::table('hrd_emp_deatils')
                            ->where('emp_id', session()->get('emp_id'))
                            ->update([
                                'emp_password' => $emp_new_passowrd
                            ]);
                if($result1 == true){
                    return redirect('login')->with(['success-alert' => 'Password Changed Successfully, Please login again']);
                }else{
                    return redirect()->back()->withErrors(['password-reset-error' => 'Try Again, Something Went Worng']);
                }
            }
        }else{
            return redirect()->back()->withErrors(['password-reset-error' => 'Previous password not mached']);
        }
    }

    public function employeeDeatilIndex(string $emp_id)
    {
        $result = DB::table('hrd_emp_deatils')
                    ->where('emp_id', $emp_id)
                    ->get();

        $result1 = DB::table('hrd_emp_qul')
                    ->where('emp_id', $emp_id)
                    ->get();
        if($result1->has([0])){
            $qualification = $result1;
        }

        $result2 = DB::table('hrd_emp_we')
                    ->where('emp_id', $emp_id)
                    ->get();
        if($result1->has([0])){
            $experience = $result2;
        }

        $result3 = DB::table('hrd_emp_bd')
                    ->where('emp_id', $emp_id)
                    ->get();
        if($result3->has([0])){
            $bank = $result3;
        }

        return view('admin.employee-management.employee-detail', ['result' => $result, 'qualification' => $qualification, 'experience' => $experience, 'bank' => $bank]);
    }
}
