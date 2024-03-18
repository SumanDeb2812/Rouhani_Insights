<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'emp_id' => 'required',
            'emp_password' => 'required'
        ]);
        if($validate == true){
            $emp_id = $request->get('emp_id');
            $emp_password = md5($request->get('emp_password'));
            $result = DB::table('hrd_emp_deatils')
                ->where('emp_id', $emp_id)
                ->where('emp_password', $emp_password)
                ->get();
            if($result->has([0])){
                //here it check if the employee login 1st time or not
                if($result[0]->first_time_login == 0){
                    session()->put([
                        'emp_id' => $result[0]->emp_id,
                    ]);
                    return redirect('/admin/set-password')->with(['ftl_msg' => 'Please change your one time system generated password']);
                }else{
                    foreach($result as $row){
                        session()->put([
                            'emp_fname' => $row->emp_fname, 
                            'emp_id' => $row->emp_id,
                        ]);
                    }
                    //login with employee profile
                    DB::update("UPDATE wb_emp_auth SET auth_status = CASE WHEN role_id = 3 THEN 1 WHEN role_id = 1 THEN 0 WHEN role_id = 2 THEN 0 WHEN role_id = 4 THEN 0 WHEN role_id = 5 THEN 0 WHEN role_id = 6 THEN 0 END WHERE emp_id = '{$emp_id}'");
    
                    $result1 = DB::table('wb_emp_auth')
                                ->select('role_id')
                                ->where('emp_id', $emp_id)
                                ->where('auth_status', 1)
                                ->get();
                    foreach($result1 as $row1){
                        session()->put([
                            'active_role' => $row1->role_id,
                        ]);
                    }
                    return redirect('/admin/dashboard');
                }  
            }else{
                return redirect('/login')->withErrors(['loginerror' => 'Employee Id and Password not matched']);
            }
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
