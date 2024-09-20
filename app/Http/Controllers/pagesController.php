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
            // echo 'Admin';
        }else{
            // echo 'General User';
            return redirect()->route('user.index');
        }
    }

    public function dashboard()
    {
        $hcode = Auth::user()->hcode;
        $query_count = "SELECT
        (SELECT COUNT(*) FROM plan_list WHERE plan_hos = $hcode) AS total,
        (SELECT COUNT(*) FROM plan_list WHERE plan_status = 1 AND plan_hos = $hcode) AS 'wait',
        (SELECT COUNT(*) FROM plan_list WHERE plan_status = 2 AND plan_hos = $hcode) AS 'progress',
        (SELECT COUNT(*) FROM plan_list WHERE plan_status = 3 AND plan_hos = $hcode) AS 'approve'";

        $count = DB::select($query_count);

        $data = DB::table('plan_list')
                ->leftjoin('plan_budget','plan_budget.budget_id','plan_list.plan_budget_id')
                ->leftjoin('p_status','p_status.p_status_id','plan_list.plan_status')
                ->where('plan_hos',$hcode)
                ->get();
        $budget = DB::table('plan_budget')->get();
        return view('hospital.index',
        [
            'count' => $count,
            'data' => $data,
            'budget' => $budget,
        ]);
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
            ],
            [
                'plan_name.required' => 'ระบุชื่อแผนงานโครงการ',
                'plan_budget_id.required' => 'ระบุแหล่งงบประมาณ',
                'plan_total.required' => 'ระบุจำนวนเงิน',
            ],
        );

        DB::table('plan_list')->insert([
            'uuid' => Str::uuid()->toString(),
            'plan_hos'=>$hcode,
            'plan_name'=>$request->plan_name,
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
            ],
            [
                'plan_name.required' => 'ระบุชื่อแผนงานโครงการ',
                'plan_budget_id.required' => 'ระบุแหล่งงบประมาณ',
                'plan_total.required' => 'ระบุจำนวนเงิน',
            ],
        );

        DB::table('plan_list')->where('uuid',$id)->update([
            'plan_hos'=>$hcode,
            'plan_name'=>$request->plan_name,
            'plan_budget_id'=>$request->plan_budget_id,
            'plan_total'=>$request->plan_total,
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
                ->orderBy('create_at','DESC')
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
}
