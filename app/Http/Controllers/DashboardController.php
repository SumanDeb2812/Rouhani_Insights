<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class DashboardController extends Controller
{
    public function index()
    {
        $result1 = DB::table('wb_emp_auth')
            ->where('emp_id', session()->get('emp_id'))
            ->get();
        foreach($result1 as $row1){
            if($row1->role_id != 3){
                $result2 = DB::table('wb_emp_auth')
                ->join('wb_emp_role', 'wb_emp_auth.role_id', '=', 'wb_emp_role.role_id')
                ->select('wb_emp_auth.*', 'wb_emp_role.role_name')
                ->where('emp_id', session()->get('emp_id'))
                ->where('auth_status', 0)
                ->get();
                return view('admin.rouhani-dashboard', ['result' => $result2]);
            }
        }
        return view('admin.rouhani-dashboard');
        
    }

    public function changeRole(Request $request)
    {
        $emp_id = session()->get('emp_id');
        $validate = $request->validate(['role_id' => 'required']);
        if($validate == true){
            for($i = 1; $i <= 6; $i++){
                if($request->get('role_id') == $i){
                    DB::update("UPDATE wb_emp_auth SET auth_status = CASE WHEN role_id = $i THEN 1 WHEN role_id != $i THEN 0 END WHERE emp_id = '{$emp_id}'");
                }
            }
            $result = DB::table('wb_emp_auth')
                        ->select('role_id')
                        ->where('emp_id', $emp_id)
                        ->where('auth_status', 1)
                        ->get();
            foreach($result as $row){
                session()->put(['active_role' => $row->role_id]);
            }
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    public function webAuthIndex()
    {
        $result1 = DB::table('hrd_emp_deatils')
                    ->select('emp_id', 'emp_fname', 'emp_lname')
                    ->get();
        $result2 = DB::table('wb_emp_role')
                    ->get();
        $result3 = DB::table('wb_emp_auth')
                    ->join('hrd_emp_deatils', 'wb_emp_auth.emp_id', '=', 'hrd_emp_deatils.emp_id')
                    ->join('wb_emp_role', 'wb_emp_role.role_id', '=', 'wb_emp_auth.role_id')
                    ->whereNot('wb_emp_role.role_id', 3)
                    ->select('hrd_emp_deatils.*')
                    ->distinct()
                    ->get();
        return view('admin.wb-auth', [
            'emp' => $result1,
            'role' => $result2,
            'auth' => $result3
        ]);
    }

    public function getRole(Request $request)
    {
        $emp_id = $request->get('emp_id');
        $result = DB::table('wb_emp_auth')
                    ->join('wb_emp_role', 'wb_emp_auth.role_id', '=', 'wb_emp_role.role_id')
                    ->where('wb_emp_auth.emp_id', $emp_id)
                    ->whereNot('wb_emp_role.role_id', 3)
                    ->select('wb_emp_auth.*', 'wb_emp_role.*')
                    ->get();
        return json_encode($result);
    }

    public function assignRole(Request $request)
    {
        $validate = $request->validate([
            'emp_id' => 'required',
            'role_id' => 'required',
        ]);
        if($validate == true){
            $emp_id = $request->get('emp_id');
            $role_id = $request->get('role_id');
            $result = DB::table('wb_emp_auth')
                    ->select('emp_id', 'role_id')
                    ->get();
            $b = implode(",", [$emp_id, $role_id]);
            foreach($result as $row){
                $a = implode(",", [$row->emp_id, $row->role_id]);
                if($a === $b){
                    return redirect()->back()->withErrors(['role_error' => 'Selected role have already assigned to selected employee']);
                }
            }
            if($role_id == 5 or $role_id == 6){
                $request->validate([
                    'au_emp_id' => 'required'
                ],[
                    'required' => 'In case of forwarding and reporting authority authorize field is must'
                ]);
                $au_emp_id = $request->get('au_emp_id');
                // $result1 = DB::table('wb_emp_auth')
                //     ->join('hrd_emp_authority', 'wb_emp_auth.emp_id', '=', 'hrd_emp_authority.emp_id')
                //     ->select('wb_emp_auth.emp_id', 'wb_emp_auth.role_id', 'hrd_emp_authority.frwd_auth')
                //     ->get();
                // foreach($result1 as $row2){
                //     $a = implode(",", [$row2->emp_id, $row2->role_id, $row2->frwd_auth]);
                //     $c = "";
                //     foreach($au_emp_id as $i){
                //         $c .= implode(",", [$emp_id, $role_id, $i]);
                //         if($a === $c){
                //             return redirect()->back()->withErrors(['role_error' => 'Selected role have already assigned to selected employee']);
                //         }
                //     }
                // }
                $result2 = DB::table('wb_emp_auth')
                            ->insert([
                                'emp_id' => $emp_id,
                                'role_id' => $role_id
                            ]);
                if($role_id == 5){
                    foreach($au_emp_id as $a){
                        DB::table('hrd_emp_authority')
                            ->insert([
                                'emp_id' => $a,
                                'frwd_auth' => $emp_id
                            ]);
                    }
                }elseif($role_id == 6) {
                    foreach($au_emp_id as $a){
                        DB::table('hrd_emp_authority')
                            ->insert([
                                'emp_id' => $a,
                                'report_auth' => $emp_id
                            ]);
                    }
                }
            }else{
                $result2 = DB::table('wb_emp_auth')
                            ->insert([
                                'emp_id' => $emp_id,
                                'role_id' => $role_id
                            ]);
            }
            if($result2 == true){
                return redirect()->back()->with(['success' => 'Role assigned to this selected employee successfully']);
            }else{
                return redirect()->back()->withErrors(['role_error' => 'Internal server error!']);
            }
        }
    }

    //leave notification depends on 3 tables
    // 1. leave_register_emp
    // 2. leave_notification_catch
    // 3. wb_emp_auth

    public function checkLeaveNotification()
    {
        //here it check the levae notification alert can seen by those
        //who has role- 1,4,5,6 assign to them
        //and if leave_notification_status on wb_emp_auth table is 0
        $result= DB::table('wb_emp_auth')
                    ->where(function (Builder $query) {
                        $query->where('wb_emp_auth.emp_id', session()->get('emp_id'))
                            ->where('leave_notification_status', 0);
                    })
                    ->where(function (Builder $query) {
                        $query ->where('role_id', 1)
                            ->orWhere('role_id', 4)
                            ->orWhere('role_id', 5)
                            ->orWhere('role_id', 6);
                    })
                    ->get();  
        if($result->has([0])){
            //here it check which authorized employee can seen which leave notifications
            $result2= DB::table('wb_emp_auth')
                    ->where('wb_emp_auth.emp_id', session()->get('emp_id'))
                    ->get();
            foreach($result2 as $row){
                if($row->role_id == 1 or $row->role_id == 4){
                    $result1 = DB::table('leave_notification_catch')
                                ->join('hrd_emp_deatils', 'leave_notification_catch.emp_id', '=', 'hrd_emp_deatils.emp_id')
                                ->select('hrd_emp_deatils.emp_fname', 'leave_notification_catch.leave_id')
                                ->get();
                    return json_encode($result1);
                }
            }
            foreach($result2 as $row){
                if($row->role_id == 5){
                    $result1 = DB::table('leave_notification_catch')
                                ->join('hrd_emp_deatils', 'leave_notification_catch.emp_id', '=', 'hrd_emp_deatils.emp_id')
                                ->join('hrd_emp_authority', 'leave_notification_catch.emp_id', '=', 'hrd_emp_authority.emp_id')
                                ->select('hrd_emp_deatils.emp_fname', 'leave_notification_catch.leave_id')
                                ->where('hrd_emp_authority.frwd_auth', session()->get('emp_id'))
                                ->get();
                    return json_encode($result1);
                }
            }
            foreach($result2 as $row){
                if ($row->role_id == 6) {
                    $result1 = DB::table('leave_notification_catch')
                                ->join('hrd_emp_deatils', 'leave_notification_catch.emp_id', '=', 'hrd_emp_deatils.emp_id')
                                ->join('hrd_emp_authority', 'leave_notification_catch.emp_id', '=', 'hrd_emp_authority.emp_id')
                                ->select('hrd_emp_deatils.emp_fname', 'leave_notification_catch.leave_id')
                                ->where('hrd_emp_authority.report_auth', session()->get('emp_id'))
                                ->get();
                    return json_encode($result1);
                }
            }   
            return json_encode([]);
        }else{
            return json_encode([]);
        }
    }

    public function updateNotificationStatus()
    {
        DB::table('wb_emp_auth')
            ->where('emp_id', session()->get('emp_id'))
            ->update([
                'leave_notification_status' => 1
            ]);
        //here it check that all leave notifications are seen by every role assigned employees or not
        $result4 = DB::table('wb_emp_auth')
                    ->where('leave_notification_status', 0)
                    ->get();
        if($result4->has([0])){
            //if all notifications were not seen by everyone then result = 0 so do nothing
        }else{
            //if all notifications were not seen by everyone then result != 0; so clear the table
            DB::table('leave_notification_catch')->truncate();
        }
    }
}
