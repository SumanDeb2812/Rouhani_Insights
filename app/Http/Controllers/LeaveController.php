<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LeaveController extends Controller
{
    public function index()
    {
        if(session()->get('active_role') == 1 or session()->get('active_role') == 4){
            $result = DB::table('leave_register_emp')
                        ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                        ->where('leave_status', 1)
                        ->orWhere('leave_status', 2)
                        ->get();
        }elseif(session()->get('active_role') == 3){
            $result = DB::table('leave_register_emp')
                        ->where('emp_id', session()->get('emp_id'))
                        ->orderBy('applied_on', 'desc')
                        ->paginate(7);
        }elseif(session()->get('active_role') == 5){
            $result = DB::table('leave_register_emp')
                        ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                        ->join('hrd_emp_authority', 'leave_register_emp.emp_id', '=', 'hrd_emp_authority.emp_id')
                        ->select('leave_register_emp.*', 'hrd_emp_deatils.*')
                        ->where('hrd_emp_authority.frwd_auth', session()->get('emp_id'))
                        ->Where('leave_register_emp.leave_status', 1)
                        ->orderBy('applied_on', 'desc')
                        ->get();
        }elseif(session()->get('active_role') == 6){
            $result = DB::table('leave_register_emp')
                        ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                        ->join('hrd_emp_authority', 'leave_register_emp.emp_id', '=', 'hrd_emp_authority.emp_id')
                        ->select('leave_register_emp.*', 'hrd_emp_deatils.*')
                        ->where('hrd_emp_authority.report_auth', session()->get('emp_id'))
                        ->where('leave_register_emp.leave_status', 1)
                        ->orWhere('leave_register_emp.leave_status', 2)
                        ->orderBy('applied_on', 'desc')
                        ->get();
        }
        if($result->has([0])){
            return view('admin.leave-management.leave', ['result' => $result]);
        }
        return view('admin.leave-management.leave');
    }

    public function assignLeave()
    {
        $result = DB::table('hrd_emp_deatils')
            ->select('emp_id', 'emp_fname', 'emp_lname')
            ->get();
        return view('admin.leave-management.assign-leave', ['result' => $result]);
    }

    public function leaveAssign(Request $request)
    {
        $leavetype = $request->get('leave-type');
        $empid = $request->get('emp-id');
        $leaveamount = $request->get('leave-amount');
        $array = [];
        for($i = 0; $i < count($leavetype); $i++){
            $a = null;
            $b = null;
            $c = null;
            for($j = $i; $j <= $i; $j++){
                $a .= $leavetype[$j];
            }
            for($j = $i; $j <= $i; $j++){
                $b .= $empid[$j];
            }
            for($j = $i; $j <= $i; $j++){
                $c .= $leaveamount[$j];
            }

            $result = DB::table('leave_manager')
                ->select('leave_type', 'emp_id')
                ->get();
            foreach($result as $row){
                array_push($array, $row->leave_type . " " . $row->emp_id);
            }
            if(in_array($a . " " . $b, $array)){
                return redirect()->back()->withErrors(['error' => 'The leave type is already assign to the selected employee']);
            }else{
                DB::table('leave_manager')
                    ->insert([
                        'leave_type' => $a, 
                        'emp_id' => $b, 
                        'leave_amount' => $c
                    ]);
            }
        }
        return redirect()->back()->with(['success' => 'Leave register update successfully']);
    }

    public function applyLeave()
    {
        $flag = [];
        //this query is used to check whether or not this logged in employee has any leaves.
        $result1 = DB::table('leave_manager')
                    ->where('emp_id', session()->get('emp_id'))
                    ->get();
        //this query is used to get employee name for 'work_adjustment'
        $result2 = DB::table('hrd_emp_deatils')
                    ->select('emp_id', 'emp_fname', 'emp_lname')
                    ->whereNot('emp_id', session()->get('emp_id'))
                    ->get();
        //this query is used to get how much leaves the employee has already taken.
        $result3 = DB::table('leave_register_emp')
                    ->select('leave_type')
                    ->selectRaw('sum(leave_taken) as leave_count')
                    ->groupBy('leave_type')
                    ->where('emp_id', session()->get('emp_id'))
                    ->get();
        foreach($result1 as $row1){
            foreach($result3 as $row3){
                if($row1->leave_type == $row3->leave_type){
                    if($row3->leave_count < $row1->leave_amount){
                        $flag[] = 1;
                    }
                }
            }
        }
        if($result1->has([0]) and count($flag) != 0){
            return view('admin.leave-management.apply-leave', ['result1' => $result1, 'emp' => $result2, 'leave' => $result3]);
        }
        elseif($result1->has([0]) and count($flag) == 0){
            return view('admin.leave-management.apply-leave', ['result1' => $result1, 'leave' => $result3]);
        }else{
            return view('admin.leave-management.apply-leave');
        }
        
    }

    public function leaveApply(Request $request)
    {
        $flag = 0;
        $validate = $request->validate([
            'leave-type' => 'required',
            'leave-from-date' => 'required',
            'leave-to-date' => 'required',
            'leave-reason' => 'required',
        ]);
        if($validate == true){
            $leave_type = $request->get('leave-type');
            $leave_from_date = $request->get('leave-from-date');
            $leave_to_date = $request->get('leave-to-date');
            $leave_taken = $request->get('leave-taken');
            $leave_reason = $request->get('leave-reason');
            $leave_file = $request->get('leave-file');
            $work_adjustment = $request->get('work-adjustment');
            //to get the logged in employee's leave count of a perticular leave type
            $result = DB::table('leave_register_emp')
                        ->select('leave_type')
                        ->selectRaw('sum(leave_taken) as leave_count')
                        ->groupBy('leave_type')
                        ->where('emp_id', session()->get('emp_id'))
                        ->get();
            $result2 = DB::table('leave_manager')
                        ->where('emp_id', session()->get('emp_id'))
                        ->get();
            //here it compares when a employee apply for leave, the no of applied leave not surpass the total 
            //no of leave assined to the logged in employee which present on 'leave_manager' table
            foreach($result as $row){
                foreach($result2 as $row2){
                    if($row->leave_type ==  $leave_type and $row2->leave_type == $leave_type){
                        if(($row->leave_count + $leave_taken) <= $row2->leave_amount){
                            $flag = 1;
                        }else{
                            $flag = 0;
                        }
                    }
                }
            }
            if($flag == 1){
                $result3 = DB::table('leave_register_emp')
                                ->insertGetId([
                                    'emp_id' => session()->get('emp_id'),
                                    'leave_type' => $leave_type,
                                    'leave_taken' => $leave_taken,
                                    'leave_from_date' => $leave_from_date,
                                    'leave_to_date' => $leave_to_date,
                                    'leave_reason' => $leave_reason,
                                    'leave_file' => $leave_file,
                                    'work_adjustment' => $work_adjustment
                                ]);
                if($result3 == true){
                    //here it insert new notifications
                    //the 'leave_register_emp' table's last leave_id inserted into the 
                    //'leave_notification_catch' table
                    DB::table('leave_notification_catch')
                        ->insert([
                                'leave_id' => $result3,
                                'emp_id' => session()->get('emp_id')
                            ]);
                    //this query make leave_notification_status again 0 to show new notifications
                    // to all
                    DB::table('wb_emp_auth')
                        ->update(['leave_notification_status' => 0]);
                        
                    return redirect()->back()->with(['success' => 'Your leave request sent successfully']);
                }
            }else{
                return redirect()->back()->withErrors(['leave-exceed' => 'Leave days are exceeds its range']);
            }
            
        }
    }

    public function leaveApprove(int $id)
    {
        if(session()->get('active_role') == 5){
            $result = DB::table('leave_register_emp')
                        ->where('leave_id', $id)
                        ->update([
                            'leave_status' => 2,
                            'notification_status' => 0
                        ]);
            if($result == true){
                return redirect()->back()->with(['success' => 'Leave request forwarded to Reporting Authority']);
            }else{
                return redirect()->back()->withErrors(['leave_error' => 'Internal server error']);
            }
        }elseif(session()->get('active_role') == 4 or session()->get('active_role') == 6){
            $result = DB::table('leave_register_emp')
                    ->where('leave_id', $id)
                    ->update(['leave_status' => 3]);
            if($result == true){
                return redirect()->back()->with(['success' => 'Leave request accepted']);
            }else{
                return redirect()->back()->withErrors(['leave_error' => 'Internal server error']);
            }
        }
    }

    public function cancelLeave(int $id)
    {
        $result = DB::table('leave_register_emp')
                    ->where('leave_id', $id)
                    ->delete();
        if($result == true){
            return redirect()->back()->with(['success' => 'Leave request canceled']);
        }else{
            return redirect()->back()->withErrors(['leave_error' => 'Internal server error']);
        }
    }

    public function leaveReject(Request $request, $id)
    {
        $reject_reason = $request->get('reject-reason');
        $result = DB::table('leave_register_emp')
                    ->where('leave_id', $id)
                    ->update([
                        'reject_reason' => $reject_reason,
                        'leave_status' => 4,
                    ]);
        if($result == true){
            return redirect('/admin/leave-management')->with(['success' => 'Leave has rejected']);
        }else{
            return redirect('/admin/leave-management')->withErrors(['leave_error' => 'Internal server error']);
        }
    }

    public function wfhIndex()
    {
        return view('admin.leave-management.apply-wfh');
    }

    public function leaveReportIndex()
    {
        if(session()->get('active_role') == 1 or  session()->get('active_role') == 4){
            $result = DB::table('hrd_emp_deatils')
                    ->select('emp_id', 'emp_fname', 'emp_lname')
                    ->get();
        }elseif(session()->get('active_role') == 5){
            $result = DB::table('hrd_emp_deatils')
                    ->join('hrd_emp_authority', 'hrd_emp_deatils.emp_id', '=', 'hrd_emp_authority.emp_id')
                    ->select('hrd_emp_deatils.emp_id', 'hrd_emp_deatils.emp_fname', 'hrd_emp_deatils.emp_lname')
                    ->where('hrd_emp_authority.frwd_auth', session()->get('emp_id'))
                    ->get();
        }elseif(session()->get('active_role') == 6){
            $result = DB::table('hrd_emp_deatils')
                    ->join('hrd_emp_authority', 'hrd_emp_deatils.emp_id', '=', 'hrd_emp_authority.emp_id')
                    ->select('hrd_emp_deatils.emp_id', 'hrd_emp_deatils.emp_fname', 'hrd_emp_deatils.emp_lname')
                    ->where('hrd_emp_authority.report_auth', session()->get('emp_id'))
                    ->get();
        }
        return view('admin.leave-management.leave-report', ['result' => $result]);
    }

    public function leaveReport()
    {
        // $leave_report_cache = resource_path() . '/cache/leave-report-cache.php';
        // if(file_exists($leave_report_cache)){
        //     // $file_open = fopen($leave_report_cache, 'r');
        //     // $filesize = filesize($leave_report_cache);
        //     // return fread($file_open, $filesize);
        // }else{
            if(session()->get('active_role') == 1 or  session()->get('active_role') == 4){
                $result = DB::table('leave_register_emp')
                        ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                        ->where('leave_status', 3)
                        ->orWhere('leave_status', 4)
                        ->simplePaginate(7);
            }elseif(session()->get('active_role') == 5){
                $result = DB::table('leave_register_emp')
                        ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                        ->join('hrd_emp_authority', 'leave_register_emp.emp_id', '=', 'hrd_emp_authority.emp_id')
                        ->where('hrd_emp_authority.frwd_auth', session()->get('emp_id'))
                        ->where(function (Builder $query) {
                            $query->where('leave_status', 3)
                                ->orWhere('leave_status', 4);
                        })
                        ->simplePaginate(7);
            }elseif(session()->get('active_role') == 6){
                $result = DB::table('leave_register_emp')
                        ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                        ->join('hrd_emp_authority', 'leave_register_emp.emp_id', '=', 'hrd_emp_authority.emp_id')
                        ->where('hrd_emp_authority.report_auth', session()->get('emp_id'))
                        ->where(function (Builder $query){
                            $query->where('leave_status', 3)
                                ->orWhere('leave_status', 4);
                        })
                        ->simplePaginate(7);
            }
            // $leave_report_file = fopen($leave_report_cache, 'w');
            // fwrite($leave_report_file, json_encode($result));
            // fclose($leave_report_file);
            return view('admin.leave-management.leave-table', ['result' => $result]);
        // }
        
    }

    public function searchLeave($name = null, $fromDate = null, $toDate = null)
    {
        if($name != null and $fromDate == 'all' and $toDate == 'all'){
            $result = DB::table('leave_register_emp')
                            ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                            ->where('hrd_emp_deatils.emp_fname', 'like', '%'.$name.'%')
                            ->where(function (Builder $query){
                                $query->where('leave_register_emp.leave_status', 3)
                                    ->orWhere('leave_register_emp.leave_status', 4);
                            })
                            ->get();
        }
        if($name != null and $fromDate == 'all' and $toDate != null){
            $result = DB::table('leave_register_emp')
                            ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                            ->whereBetween('leave_register_emp.applied_on', [date('2024-01-01'), $toDate])
                            ->where('hrd_emp_deatils.emp_fname', 'like', '%'.$name.'%')
                            ->where(function (Builder $query){
                                $query->where('leave_register_emp.leave_status', 3)
                                    ->orWhere('leave_register_emp.leave_status', 4);
                            })
                            ->get();
        }
        if($name != null and $fromDate != null and $toDate != null){
            $result = DB::table('leave_register_emp')
                            ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                            ->whereBetween('leave_register_emp.applied_on', [$fromDate, $toDate])
                            ->where('hrd_emp_deatils.emp_fname', 'like', '%'.$name.'%')
                            ->where(function (Builder $query){
                                $query->where('leave_register_emp.leave_status', 3)
                                    ->orWhere('leave_register_emp.leave_status', 4);
                            })
                            ->get();
        }
        if($name == 'all' and $fromDate != null and $toDate != null){
            $result = DB::table('leave_register_emp')
                            ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                            ->whereBetween('leave_register_emp.applied_on', [$fromDate, $toDate])
                            ->where(function (Builder $query){
                                $query->where('leave_register_emp.leave_status', 3)
                                    ->orWhere('leave_register_emp.leave_status', 4);
                            })
                            ->get();
        }
        if($name != null and $fromDate != null and $toDate == 'all'){
            $result = DB::table('leave_register_emp')
                            ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                            ->where('hrd_emp_deatils.emp_fname', 'like', '%'.$name.'%')
                            ->whereBetween('leave_register_emp.applied_on', [$fromDate, now()])
                            ->where(function (Builder $query){
                                $query->where('leave_register_emp.leave_status', 3)
                                    ->orWhere('leave_register_emp.leave_status', 4);
                            })
                            ->get();
        }
        if($name == 'all' and $fromDate != null and $toDate == 'all'){
            $result = DB::table('leave_register_emp')
                            ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                            ->whereBetween('leave_register_emp.applied_on', [$fromDate, now()])
                            ->where(function (Builder $query){
                                $query->where('leave_register_emp.leave_status', 3)
                                    ->orWhere('leave_register_emp.leave_status', 4);
                            })
                            ->get();
        }
        if($name == 'all' and $fromDate == 'all'  and $toDate != null){
            $result = DB::table('leave_register_emp')
                            ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                            ->whereBetween('leave_register_emp.applied_on', [date('2024-01-01'), $toDate])
                            ->where(function (Builder $query){
                                $query->where('leave_register_emp.leave_status', 3)
                                    ->orWhere('leave_register_emp.leave_status', 4);
                            })
                            ->get();
        }
        return view('admin.leave-management.leave-table', ['result' => $result]);
    }

    public function generateLeaveReport(Request $request)
    {
        $emp_id = $request->get('emp_id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        if($emp_id != "" and $from_date != "" and $to_date != ""){
            $result = DB::table('leave_register_emp')
                        ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                        ->whereBetween('leave_register_emp.applied_on', [$from_date, $to_date])
                        ->where('leave_register_emp.emp_id', 'like', '%'.$emp_id.'%')
                        ->where(function (Builder $query){
                            $query->where('leave_register_emp.leave_status', 3)
                                ->orWhere('leave_register_emp.leave_status', 4);
                        })
                        ->get();
        }
        if($emp_id != "" and $from_date == "" and $to_date == ""){
            $result = DB::table('leave_register_emp')
                            ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                            ->where('leave_register_emp.emp_id', 'like', '%'.$emp_id.'%')
                            ->where(function (Builder $query){
                                $query->where('leave_register_emp.leave_status', 3)
                                    ->orWhere('leave_register_emp.leave_status', 4);
                            })
                            ->get();
        }
        if($emp_id != "" and $from_date != "" and $to_date == ""){
            $result = DB::table('leave_register_emp')
                        ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                        ->where('leave_register_emp.emp_id', 'like', '%'.$emp_id.'%')
                        ->whereBetween('leave_register_emp.applied_on', [$from_date, now()])
                        ->where(function (Builder $query){
                            $query->where('leave_register_emp.leave_status', 3)
                                ->orWhere('leave_register_emp.leave_status', 4);
                        })
                        ->get();
        }
        if($emp_id != "" and $from_date == "" and $to_date != ""){
            $result = DB::table('leave_register_emp')
                            ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                            ->whereBetween('leave_register_emp.applied_on', [date('2024-01-01'), $to_date])
                            ->where('leave_register_emp.emp_id', 'like', '%'.$emp_id.'%')
                            ->where(function (Builder $query){
                                $query->where('leave_register_emp.leave_status', 3)
                                    ->orWhere('leave_register_emp.leave_status', 4);
                            })
                            ->get();
        }
        if($emp_id == "" and $from_date != "" and $to_date != ""){
            $result = DB::table('leave_register_emp')
                            ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                            ->whereBetween('leave_register_emp.applied_on', [$from_date, $to_date])
                            ->where(function (Builder $query){
                                $query->where('leave_register_emp.leave_status', 3)
                                    ->orWhere('leave_register_emp.leave_status', 4);
                            })
                            ->get();
        }
        if($emp_id == "" and $from_date != "" and $to_date == ""){
            $result = DB::table('leave_register_emp')
                            ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                            ->whereBetween('leave_register_emp.applied_on', [$from_date, now()])
                            ->where(function (Builder $query){
                                $query->where('leave_register_emp.leave_status', 3)
                                    ->orWhere('leave_register_emp.leave_status', 4);
                            })
                            ->get();
        }
        if($emp_id == "" and $from_date == "" and $to_date != ""){
            $result = DB::table('leave_register_emp')
                            ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                            ->whereBetween('leave_register_emp.applied_on', [date('2024-01-01'), $to_date])
                            ->where(function (Builder $query){
                                $query->where('leave_register_emp.leave_status', 3)
                                    ->orWhere('leave_register_emp.leave_status', 4);
                            })
                            ->get();
        }

        // $spreadsheet = new Spreadsheet();
        // $activeWorksheet = $spreadsheet->getActiveSheet();
        // $activeWorksheet->setCellValue('A1', 'Leave Id')
        //                 ->setCellValue('B1', 'Employee')
        //                 ->setCellValue('C1', 'Leave Type')
        //                 ->setCellValue('D1', 'Leave Duration')
        //                 ->setCellValue('E1', 'From Date')
        //                 ->setCellValue('F1', 'To Date')
        //                 ->setCellValue('G1', 'Reason for leave')
        //                 ->setCellValue('H1', 'Work Adjustment')
        //                 ->setCellValue('I1', 'Applied On')
        //                 ->setCellValue('J1', 'Leave Status');
        
        //     for($i = 0; $i < count($result); $i++){
        //         $activeWorksheet->setCellValue('A'. ($i + 2), $result[$i]->leave_id);
        //         $activeWorksheet->setCellValue('B'. ($i + 2), $result[$i]->emp_fname . $result[$i]->emp_lname . " - " . $result[$i]->emp_id);
        //         $activeWorksheet->setCellValue('C'. ($i + 2), $result[$i]->leave_type);
        //         $activeWorksheet->setCellValue('D'. ($i + 2), $result[$i]->leave_taken);
        //         $activeWorksheet->setCellValue('E'. ($i + 2), $result[$i]->leave_from_date);
        //         $activeWorksheet->setCellValue('F'. ($i + 2), $result[$i]->leave_to_date);
        //         $activeWorksheet->setCellValue('G'. ($i + 2), $result[$i]->leave_reason);
        //         $activeWorksheet->setCellValue('H'. ($i + 2), $result[$i]-> work_adjustment);
        //         $activeWorksheet->setCellValue('I'. ($i + 2), $result[$i]->applied_on);
        //         $activeWorksheet->setCellValue('J'. ($i + 2), $result[$i]->leave_status);
        //     }

        // $writer = new Xlsx($spreadsheet);
        // $writer->save('Leave Report.xlsx');

        // $file = public_path()."/Leave Report.xlsx";
        // $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        // $fp = pfsockopen('127.0.0.1', 8000);
        // fputs($fp, $file);
        // fclose($fp);
        // return Response::download($file, 'Leave Report.xlsx', $headers)->deleteFileAfterSend(true);
        return view('admin.leave-management.print-leave-report-preview', ['result' => $result]);
    }

    public function generateLeaveReportWithoutFilter()
    {
        if(session()->get('active_role') == 1 or session()->get('active_role') == 4){
            $result = DB::table('leave_register_emp')
                    ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                    ->where('leave_status', 3)
                    ->orWhere('leave_status', 4)
                    ->get();
        }elseif(session()->get('active_role') == 5){
            $result = DB::table('leave_register_emp')
                    ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                    ->where('hrd_emp_deatils.frwd_auth', session()->get('emp_id'))
                    ->where(function (Builder $query) {
                        $query->where('leave_status', 3)
                            ->orWhere('leave_status', 4);
                    })
                    ->get();
        }elseif(session()->get('active_role') == 6){
            $result = DB::table('leave_register_emp')
                    ->join('hrd_emp_deatils', 'leave_register_emp.emp_id', '=', 'hrd_emp_deatils.emp_id')
                    ->where('hrd_emp_deatils.report_auth', session()->get('emp_id'))
                    ->where(function (Builder $query){
                        $query->where('leave_status', 3)
                            ->orWhere('leave_status', 4);
                    })
                    ->get();
        }
        // if($result->has([0])){
        //     $spreadsheet = new Spreadsheet();
        //     $activeWorksheet = $spreadsheet->getActiveSheet();
        //     $activeWorksheet->setCellValue('A1', 'Leave Id')
        //                     ->setCellValue('B1', 'Employee')
        //                     ->setCellValue('C1', 'Leave Type')
        //                     ->setCellValue('D1', 'Leave Duration')
        //                     ->setCellValue('E1', 'From Date')
        //                     ->setCellValue('F1', 'To Date')
        //                     ->setCellValue('G1', 'Reason for leave')
        //                     ->setCellValue('H1', 'Work Adjustment')
        //                     ->setCellValue('I1', 'Applied On')
        //                     ->setCellValue('J1', 'Leave Status');
            
        //         for($i = 0; $i < count($result); $i++){
        //             $activeWorksheet->setCellValue('A'. ($i + 2), $result[$i]->leave_id);
        //             $activeWorksheet->setCellValue('B'. ($i + 2), $result[$i]->emp_fname . $result[$i]->emp_lname . " - " . $result[$i]->emp_id);
        //             $activeWorksheet->setCellValue('C'. ($i + 2), $result[$i]->leave_type);
        //             $activeWorksheet->setCellValue('D'. ($i + 2), $result[$i]->leave_taken);
        //             $activeWorksheet->setCellValue('E'. ($i + 2), $result[$i]->leave_from_date);
        //             $activeWorksheet->setCellValue('F'. ($i + 2), $result[$i]->leave_to_date);
        //             $activeWorksheet->setCellValue('G'. ($i + 2), $result[$i]->leave_reason);
        //             $activeWorksheet->setCellValue('H'. ($i + 2), $result[$i]-> work_adjustment);
        //             $activeWorksheet->setCellValue('I'. ($i + 2), $result[$i]->applied_on);
        //             $activeWorksheet->setCellValue('J'. ($i + 2), $result[$i]->leave_status);
        //         }

        //     // $writer = new Xlsx($spreadsheet);
        //     // $writer->save('Leave Report.xlsx');

        //     // $file = public_path()."/Leave Report.xlsx";
        //     // $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        //     // return Response::download($file, 'Leave Report.xlsx', $headers)->deleteFileAfterSend(true);

        // }
        return view('admin.leave-management.print-leave-report-preview', ['result' => $result]);
    }
}
