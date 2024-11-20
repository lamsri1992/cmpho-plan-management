<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Auth;

class pagesController extends Controller
{
    public function index()
    {
        $check = Auth::user()->role;
        if($check == 1){
            return redirect()->route('cmpho.index');
        }else{
            return redirect()->route('user.index');
        }
    }

    public function dashboard()
    {
        $hcode = Auth::user()->hcode;
        $query_count = "SELECT
        (SELECT COUNT(*) FROM plan_list WHERE plan_hos = $hcode) AS total,
        (SELECT COUNT(*) FROM plan_list WHERE plan_status = 1 AND plan_hos = $hcode) AS 'wait',
        (SELECT COUNT(*) FROM plan_list WHERE plan_status IN (2,5) AND plan_hos = $hcode) AS 'progress',
        (SELECT COUNT(*) FROM plan_list WHERE plan_status = 3 AND plan_hos = $hcode) AS 'approve',
        (SELECT COUNT(*) FROM plan_list WHERE plan_status = 4 AND plan_hos = $hcode) AS 'edit'";

        $count = DB::select($query_count);
        $data = DB::table('plan_list')
            ->leftjoin('plan_budget','plan_budget.budget_id','plan_list.plan_budget_id')
            ->leftjoin('p_status','p_status.p_status_id','plan_list.plan_status')
            ->where('plan_hos',$hcode)
            ->where('plan_status',4)
            ->get();
        $chart = DB::table('plan_budget')
                ->select('budget_name',DB::raw('SUM(plan_total) AS total'))
                ->leftjoin('plan_list','plan_list.plan_budget_id','plan_budget.budget_id')
                ->where('plan_hos',$hcode)
                ->groupBy('budget_name')
                ->orderBy('total','DESC')
                ->get();
        return view('hospital.index',
        [
            'count' => $count,
            'data' => $data,
            'chart' => $chart,
        ]);
    }

    public function plan()
    {
        $hcode = Auth::user()->hcode;
        $data = DB::table('plan_list')
            ->leftjoin('plan_budget','plan_budget.budget_id','plan_list.plan_budget_id')
            ->leftjoin('p_status','p_status.p_status_id','plan_list.plan_status')
            ->where('plan_hos',$hcode)
            ->get();
        $budget = DB::table('plan_budget')->where('budget_status',1)->get();
        return view('hospital.list',
            [
                'data'=>$data,
                'budget'=>$budget,
            ]
        );
    }

    public function store(Request $request)
    {
        $hcode = Auth::user()->hcode;
        $currentDate = date('Y-m-d H:i:s');

        $validatedData = $request->validate(
            [
                'plan_name' => 'required',
                'plan_budget_id' => 'required',
                'plan_total' => 'required',
                'plan_doc_no' => 'required',
                'plan_doc_date' => 'required',
            ],
            [
                'plan_name.required' => 'ระบุชื่อแผนงานโครงการ',
                'plan_budget_id.required' => 'ระบุแหล่งงบประมาณ',
                'plan_total.required' => 'ระบุจำนวนเงิน',
                'plan_doc_no.required' => 'ระบุเลขที่หนังสือส่ง',
                'plan_doc_date.required' => 'ระบุลงวันที่',
            ],
        );

        DB::table('plan_list')->insert([
            'uuid' => Str::uuid()->toString(),
            'plan_hos'=>$hcode,
            'plan_name'=>$request->plan_name,
            'plan_doc_no'=>$request->plan_doc_no,
            'plan_doc_date'=>$request->plan_doc_date,
            'plan_budget_id'=>$request->plan_budget_id,
            'plan_total'=>$request->plan_total,
            'create_at'=>$currentDate
        ]);

        return back()->with('success', 'สร้างแผนงานโครงการสำเร็จ - '.$request->plan_name);
    }

    public function update(string $id, Request $request)
    {
        $hcode = Auth::user()->hcode;
        $currentDate = date('Y-m-d H:i:s');

        $validatedData = $request->validate(
            [
                'plan_name' => 'required',
                'plan_budget_id' => 'required',
                'plan_total' => 'required',
                'plan_doc_no' => 'required',
                'plan_doc_date' => 'required',
            ],
            [
                'plan_name.required' => 'ระบุชื่อแผนงานโครงการ',
                'plan_budget_id.required' => 'ระบุแหล่งงบประมาณ',
                'plan_total.required' => 'ระบุจำนวนเงิน',
                'plan_doc_no.required' => 'ระบุเลขที่หนังสือ',
                'plan_doc_date.required' => 'ระบุวันที่หนังสือ',
            ],
        );

        DB::table('plan_list')->where('uuid',$id)->update([
            'plan_hos'=>$hcode,
            'plan_name'=>$request->plan_name,
            'plan_budget_id'=>$request->plan_budget_id,
            'plan_total'=>$request->plan_total,
            'plan_doc_date'=>$request->plan_doc_date,
            'plan_doc_no'=>$request->plan_doc_no,
            'update_at'=>$currentDate
        ]);

        return back()->with('success', 'แก้ไขแผนงานโครงการสำเร็จ - '.$request->plan_name);
    }

    public function view(string $id)
    {
        $data = DB::table('plan_list')
                ->select('*','plan_list.uuid as uuid')
                ->leftjoin('hospital','hospital.h_code','plan_list.plan_hos')
                ->leftjoin('plan_budget','plan_budget.budget_id','plan_list.plan_budget_id')
                ->leftjoin('p_status','p_status.p_status_id','plan_list.plan_status')
                ->where('plan_list.uuid',$id)
                ->first();
        
        $budget = DB::table('plan_budget')->get();

        $log = DB::table('plan_log')
                ->join('departments','dept_id','log_dept_id')
                ->leftjoin('plan_log_status','plan_log_status.status_id','plan_log.log_status_id')
                ->where('log_plan_id',$id)
                ->orderBy('create_at','ASC')
                ->get();

        $logs = DB::table('plan_log_status')->get();
    
        return view('hospital.view',
        [
            'data' => $data,
            'budget' => $budget,
            'log' => $log,
            'logs' => $logs,
        ]);
    }

    public function updateLog(string $id, Request $request)
    {
        $currentDate = date('Y-m-d H:i:s');
        DB::table('plan_list')->where('uuid',$id)->update([
            'plan_status' => 5,
            'plan_receive_date' => $currentDate,
        ]);

        // Log Insert
        DB::table('plan_log')->insert(
        [
            'log_plan_id' => $id,
            'log_status_id' => 6,
            'log_note' => 'หน่วยบริการส่งกลับแก้ไขแผนงานโครงการ',
            'log_dept_id' => 4,
            'create_at' => $currentDate
        ]);
        
        return back()->with('success', 'บันทึกการดำเนินการสำเร็จ');
    }
}
