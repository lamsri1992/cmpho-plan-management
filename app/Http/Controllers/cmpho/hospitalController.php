<?php

namespace App\Http\Controllers\cmpho;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class hospitalController extends Controller
{
    public function index()
    {
        $data = DB::table('hospital')
            ->leftjoin('hospital_type','h_type_id','h_type')    
            ->get();
        $type = DB::table('hospital_type')->get();
        return view('cmpho.hospital.index',['data'=>$data,'type'=>$type]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'h_code' => 'required',
                'h_name' => 'required',
                'h_type' => 'required',
            ],
            [
                'h_code.required' => 'ระบุรหัสหน่วยบริการ',
                'h_name.required' => 'ระบุหน่วยบริการ',
                'h_type.required' => 'ระบุประเภทหน่วยบริการ',
            ],
        );

        DB::table('hospital')->insert(
            [
                'h_code' => $request->h_code,
                'h_name' => $request->h_name,
                'h_type' => $request->h_type,
            ]
        );
        return back()->with('success','เพิ่มหน่วยบริการใหม่สำเร็จ : '.$request->h_name);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'h_code' => 'required',
                'h_name' => 'required',
                'h_type' => 'required',
            ],
            [
                'h_code.required' => 'ระบุรหัสหน่วยบริการ',
                'h_name.required' => 'ระบุหน่วยบริการ',
                'h_type.required' => 'ระบุประเภทหน่วยบริการ',
            ],
        );

        DB::table('hospital')->where('h_id',$id)->update(
            [
                'h_code' => $request->h_code,
                'h_name' => $request->h_name,
                'h_type' => $request->h_type,
            ]
        );
        return back()->with('success','แก้ไขหน่วยบริการสำเร็จ : '.$request->h_name);
    }

    public function show($id)
    {
        $data = DB::table('hospital')
            ->leftjoin('hospital_type','h_type_id','h_type')
            ->where('hospital.h_id',$id)
            ->first();
        $type = DB::table('hospital_type')->get();
        return view('cmpho.hospital.view',['data'=>$data,'type'=>$type]);
    }
}
