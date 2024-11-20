<?php

namespace App\Http\Controllers\cmpho;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class budgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('plan_budget')->get();
        return view('cmpho.budget.index',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'budget_name' => 'required',
            ],
            [
                'budget_name.required' => 'ระบุชื่อแหล่งงบประมาณ',
            ],
        );

        DB::table('plan_budget')->insert(
            [
                'budget_name' => $request->budget_name
            ]
        );
        return back()->with('success','เพิ่มแหล่งงบประมาณใหม่สำเร็จ - '.$request->budget_name);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function changed(Request $request)
    {
        $check = DB::table('plan_budget')->where('budget_id',$request->id)->first();
        if($check->budget_status == 1){
            DB::table('plan_budget')->where('budget_id',$request->id)->update(['budget_status' => 2]);
            // echo "Disabled";
        }else if($check->budget_status == 2){
            DB::table('plan_budget')->where('budget_id',$request->id)->update(['budget_status' => 1]);
            // echo "Enabled";
        }
    }
}
