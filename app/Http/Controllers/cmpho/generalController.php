<?php

namespace App\Http\Controllers\cmpho;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use File;

class generalController extends Controller
{
    public function index()
    {
        $query_count = "SELECT
        (SELECT COUNT(*) FROM `plan_list`) AS total,
        (SELECT COUNT(*) FROM `plan_list` WHERE plan_status = 1) AS 'wait',
        (SELECT COUNT(*) FROM `plan_list` WHERE plan_status = 2) AS 'progress',
        (SELECT COUNT(*) FROM `plan_list` WHERE plan_status = 3) AS 'approve'";

        $count = DB::select($query_count);
        
        $data = DB::table('plan_list')
                ->leftjoin('plan_budget','plan_budget.budget_id','plan_list.plan_budget_id')
                ->leftjoin('p_status','p_status.p_status_id','plan_list.plan_status')
                ->leftjoin('hospital','hospital.h_code','plan_list.plan_hos')
                ->get();
        return view('cmpho.index',
        [
            'count' => $count,
            'data' => $data,
        ]);
    }

    public function update(string $id, Request $request)
    {
        $currentDate = date('Y-m-d H:i:s');
        // $validatedData = $request->validate(
        //     [
        //         'plan_doc_no' => 'required',
        //         'plan_doc_date' => 'required',
        //         'plan_receive' => 'required',
        //     ],
        //     [
        //         'plan_doc_no.required' => 'ระบุเลขที่หนังสือ',
        //         'plan_doc_date.required' => 'ระบุวันที่หนังสือ',
        //         'plan_receive.required' => 'ระบุผู้รับเข้าแผนงานโครงการ',
        //     ],
        // );

        DB::table('plan_list')->where('uuid',$id)->update([
            // 'plan_doc_date'=>$request->plan_doc_date,
            // 'plan_doc_no'=>$request->plan_doc_no,
            'plan_receive'=>$request->plan_receive,
            'plan_receive_date'=>$currentDate,
            'plan_status'=>2
        ]);

        // Log Insert
        DB::table('plan_log')->insert([
            'log_plan_id' => $id,
            'log_status_id' => 1,
            'log_dept_id'=>Auth::user()->department_id,
            'create_at' => $currentDate
        ]);

        return back()->with('success', 'รับเข้าแผนงานโครงการสำเร็จ - '.$request->plan_name);
    }

    public function updateLog(string $id, Request $request)
    {
        $currentDate = date('Y-m-d H:i:s');
        $validatedData = $request->validate(
            [
                'plan_log_status' => 'required',
            ],
            [
                'plan_log_status.required' => 'ระบุเลือกการดำเนินการ',
            ],
        );

        DB::table('plan_list')->where('uuid',$id)->update([
            'plan_receive_date'=>$currentDate,
        ]);

        // Log Insert
        DB::table('plan_log')->insert([
            'log_plan_id' => $id,
            'log_status_id' => $request->plan_log_status,
            'log_note' => $request->log_note,
            'log_dept_id'=>$request->department,
            'create_at' => $currentDate
        ]);

        return back()->with('success', 'บันทึกการดำเนินการสำเร็จ');
    }

    public function view(string $id)
    {
        $data = DB::table('plan_list')
                ->leftjoin('hospital','hospital.h_code','plan_list.plan_hos')
                ->leftjoin('plan_budget','plan_budget.budget_id','plan_list.plan_budget_id')
                ->leftjoin('p_status','p_status.p_status_id','plan_list.plan_status')
                ->where('uuid',$id)
                ->first();
        
        $log = DB::table('plan_log')
                ->join('departments','dept_id','log_dept_id')
                ->leftjoin('plan_log_status','plan_log_status.status_id','plan_log.log_status_id')
                ->where('log_plan_id',$id)
                ->orderBy('log_plan_id','ASC')
                ->get();

        $logs = DB::table('plan_log_status')->get();
        $dept = DB::table('departments')->get();
        $budget = DB::table('plan_budget')->get();
        $check = DB::table('plan_log')
                ->where('log_plan_id',$id)
                ->where('log_dept_id',3)
                ->where('log_status_id',4)
                ->count();
    
        return view('cmpho.view',
        [
            'data' => $data,
            'log' => $log,
            'logs' => $logs,
            'dept' => $dept,
            'budget' => $budget,
            'check' => $check,
        ]);
    }

    public function approve(string $id, Request $request)
    {
        $currentDate = date('Y-m-d H:i:s');
        $validatedData = $request->validate(
            [
                'app_date' => 'required',
                'plan_no' => 'required',
                'file' => 'required',
            ],
            [
                'app_date.required' => 'ระบุวันที่อนุมัติแผนงานโครงการ',
                'plan_no.required' => 'ระบุเลขที่หนังสือ',
                'file.required' => 'กรุณาแนบไฟล์เอกสาร',
            ],
        );

        $file  = $request->file('file');
        $fileName = $id.".pdf";
        $destination = public_path('uploads/');

        File::makeDirectory($destination, 0755, true, true);
        $file->move(public_path('uploads/'), $fileName);

        DB::table('plan_list')->where('uuid',$id)->update([
            'update_at'=>$currentDate,
            'plan_approve_date'=>$request->app_date,
            'plan_approve_doc_no'=>$request->plan_no,
            'plan_files'=>$fileName,
            'plan_status'=>3,
        ]);

         // Log Insert
         DB::table('plan_log')->insert([
            'log_plan_id' => $id,
            'log_status_id' => 5,
            'log_note' => 'แผนงานโครงการถูกอนุมัติแล้ว',
            'log_dept_id'=>1,
            'create_at' => $currentDate
        ]);
        
        return back()->with('success', 'บันทึกอนุมัติโครงการสำเร็จ');
    }
}
