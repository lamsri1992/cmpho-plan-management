<?php

namespace App\Http\Controllers\cmpho;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('users')
            ->join('role','role_id','users.role')
            ->join('hospital','h_code','users.hcode')
            ->join('departments','dept_id','users.department_id')
            ->get();
        $hosp = DB::table('hospital')->get();
        $dept = DB::table('departments')->get();
        $role = DB::table('role')->get();
        return view('cmpho.user.index',[
            'data'=>$data,
            'hosp'=>$hosp,
            'dept'=>$dept,
            'role'=>$role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'department' => 'required',
                'hcode' => 'required',
                'role' => 'required',
            ],
            [
                'name.required' => 'ระบุชื่อผู้ใช้งาน',
                'email.required' => 'ระบุบัญชีผู้ใช้งาน',
                'department.required' => 'ระบุหน่วยงาน',
                'hcode.required' => 'ระบุหน่วยบริการ',
                'role.required' => 'ระบุสิทธิการใช้งาน',
            ],
        );

        DB::table('users')->insert([
            'uuid' => Str::uuid()->toString(),
            'password' => Hash::make($request->hcode),
            'name' => $request->name,
            'email' => $request->email,
            'hcode' => $request->hcode,
            'department_id' => $request->department,
            'role' => $request->role,
        ]);
        return back()->with('success', 'เพิ่มผู้ใช้งานใหม่แล้ว - '.$request->name);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DB::table('users')
            ->select('uuid','name','hcode','email','role','department_id')
            ->join('role','role_id','users.role')
            ->join('hospital','h_code','users.hcode')
            ->join('departments','dept_id','users.department_id')
            ->where('uuid',$id)
            ->first();
        $hosp = DB::table('hospital')->get();
        $dept = DB::table('departments')->get();
        $role = DB::table('role')->get();
        return view('cmpho.user.view',[
            'data'=>$data,
            'hosp'=>$hosp,
            'dept'=>$dept,
            'role'=>$role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'department' => 'required',
                'hcode' => 'required',
                'role' => 'required',
            ],
            [
                'name.required' => 'ระบุชื่อผู้ใช้งาน',
                'email.required' => 'ระบุบัญชีผู้ใช้งาน',
                'department.required' => 'ระบุหน่วยงาน',
                'hcode.required' => 'ระบุหน่วยบริการ',
                'role.required' => 'ระบุสิทธิการใช้งาน',
            ],
        );

        DB::table('users')->where('uuid',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'hcode' => $request->hcode,
            'department_id' => $request->department,
            'role' => $request->role,
        ]);
        return back()->with('success', 'แก้ไขข้อมูลผู้ใช้งานแล้ว - '.$request->name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
