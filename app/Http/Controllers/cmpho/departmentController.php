<?php

namespace App\Http\Controllers\cmpho;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class departmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('departments')->get();
        return view('cmpho.department.index',
            [
                'data' => $data
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'dept_name' => 'required',
            ],
            [
                'dept_name.required' => 'ระบุชื่อกลุ่มงาน',
            ],
        );

        DB::table('departments')->insert(
            [
                'dept_name' => $request->dept_name
            ]
        );
        return back()->with('success','เพิ่มกลุ่มงานใหม่สำเร็จ - '.$request->dept_name);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DB::table('departments')->where('dept_id',$id)->first();
        return view('cmpho.department.view',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate(
            [
                'dept_name' => 'required',
            ],
            [
                'dept_name.required' => 'ระบุชื่อกลุ่มงาน',
            ],
        );

        DB::table('departments')->where('dept_id',$id)->update(
            [
                'dept_name' => $request->dept_name
            ]
        );
        return back()->with('success','แก้ไขกลุ่มงานสำเร็จ - '.$request->dept_name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
