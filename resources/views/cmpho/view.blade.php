@extends('app.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <i class="fa-regular fa-folder-open"></i> 
                            แผนงานโครงการ
                        </li>
                        <li class="breadcrumb-item active">
                            {{ $data->plan_name }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">
                                        <i class="fa-regular fa-clipboard"></i>
                                        ข้อมูลแผนงานโครงการ
                                    </h5>
                                </div>
                                <div class="col-md-6 text-right">
                                    <span class="{{ $data->p_status_color }}">
                                        {!! $data->p_status_icon !!}
                                    </span>
                                    {{ $data->p_status_name }}
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('cmpho.update',$data->uuid) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                <i class="fa-regular fa-file"></i>
                                                ชื่อแผนงานโครงการ
                                            </label>
                                            <input type="text" name="plan_name" class="form-control" value="{{ $data->plan_name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <i class="fa-solid fa-wallet"></i>
                                                แหล่งงบประมาน
                                            </label>
                                            <select name="plan_budget_id" class="basic-single">
                                                <option></option>
                                                @foreach ($budget as $rs)
                                                <option value="{{ $rs->budget_id }}"
                                                    {{ ($rs->budget_id == $data->plan_budget_id) ? 'SELECTED':'' }}>
                                                    {{ $rs->budget_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <i class="fa-solid fa-comment-dollar"></i>
                                                จำนวนเงิน
                                            </label>
                                            <input type="text" class="form-control" name="plan_total" value="{{ $data->plan_total }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="fa-regular fa-file-alt"></i>
                                                เลขที่หนังสือ
                                            </label>
                                            <input type="text" name="plan_doc_no" class="form-control" value="{{ $data->plan_doc_no }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="fa-regular fa-calendar-check"></i>
                                                ลงวันที่
                                            </label>
                                            <input type="text" name="plan_doc_date" class="form-control pickr" value="{{ $data->plan_doc_date }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="fa-solid fa-user-check"></i>
                                                ผู้รับแผนงานโครงการ
                                            </label>
                                            <input type="text" name="plan_receive" class="form-control" value="{{ Auth::user()->name }}" @readonly(true)>
                                        </div>
                                    </div>
                                    @if ($data->p_status_id == 1)
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success"
                                            onclick="
                                                Swal.fire({
                                                    icon: 'question',
                                                    title: 'ยืนยันรับเข้าแผนงานโครงการ ?',
                                                    text: '{{ 'REF_ID : '.$data->uuid }}',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'รับเข้าแผนงานโครงการ',
                                                    cancelButtonText: 'ยกเลิก',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        form.submit()
                                                    } else if (result.isDenied) {
                                                        form.clear()
                                                }
                                                });
                                            ">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                            รับเข้าแผนงานโครงการ
                                        </button>
                                    </div>
                                    @endif
                                    @if ($check == 1 && $data->plan_status == 2)
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approve">
                                            <i class="fa-solid fa-envelope-circle-check"></i>
                                            บันทึกอนุมัติโครงการ
                                        </button>
                                    </div>
                                    @endif
                                    @if ($data->plan_status == 3)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="fa-regular fa-file-alt"></i>
                                                เลขที่หนังสือ <small>(อนุมัติแผนงานโครงการ)</small>
                                            </label>
                                            <input type="text" class="form-control" value="{{ $data->plan_approve_doc_no }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="fa-regular fa-calendar-check"></i>
                                                วันที่ <small>(อนุมัติแผนงานโครงการ)</small>
                                            </label>
                                            <input type="text" class="form-control pickr" value="{{ $data->plan_approve_date }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="fa-solid fa-download"></i>
                                                ไฟล์เอกสารแผนงานโครงการ <small>(ฉบับสมบูรณ์)</small>
                                            </label>
                                            <br>
                                            <div class="mt-2">
                                                <a href="{{ asset('uploads/'.$data->plan_files) }}" target="_blank">
                                                    <i class="fa-regular fa-file-pdf text-danger"></i>
                                                    {{ $data->plan_files }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-12 text-center">
                                        <small><i class="fa-regular fa-calendar-plus"></i> วันที่สร้าง : {{ date("d/m/Y", strtotime($data->create_at)) }}</small>
                                        <small><i class="fa-regular fa-calendar-check"></i> แก้ไขล่าสุด : {{ date("d/m/Y", strtotime($data->update_at)) }}</small>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if ($data->p_status_id != 1)
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa-solid fa-timeline"></i>
                        Time Line แผนงานโครงการ
                    </h3>
                </div>
                <div class="card-body">
                    <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                        @foreach ($log as $rs)
                        <div class="timeline-step">
                            <div class="timeline-content">
                                <div class="inner-circle"></div>
                                <p class="h6 mt-3 mb-1">
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ date('d/m/Y' , strtotime($rs->create_at)) }}
                                </p>
                                <p class="h6 mb-0 mb-lg-0">
                                    <a href="#"
                                        onclick="Swal.fire({
                                            icon: 'success',
                                            text: '{{ $rs->log_note }}',
                                        });">
                                        {{ $rs->status_name }}
                                    </a>
                                    <br>
                                    <small class="text-muted">
                                        {{ $rs->dept_name }}
                                    </small>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if ($check == 0)
                    <div class="col-md-12 mt-4 text-center">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#process">
                                <i class="fa-solid fa-check-square"></i>
                                ดำเนินการ
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </section>
</div>
<!-- Modal Process -->
<div class="modal fade" id="process" tabindex="-1" aria-labelledby="processLabel" aria-hidden="true">
    <form action="{{ route('cmpho.update.log',$data->uuid) }}" method="POST">
        @csrf
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="processLabel">
                        <i class="fa-solid fa-check-square"></i>
                        ดำเนินการ
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>หมายเหตุ</label>
                            <input type="text" name="log_note" class="form-control" placeholder="ระบุหมายเหตุ">
                        </div>
                        <div class="form-group col-md-6">
                            <label>ดำเนินการ</label>
                            <select name="plan_log_status" class="basic-single">
                                <option></option>
                                @foreach ($logs as $rs)
                                <option value="{{ $rs->status_id }}">
                                    {{ $rs->status_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>ดำเนินการโดย</label>
                            <select name="department" class="basic-single">
                                <option></option>
                                @foreach ($dept as $rs)
                                <option value="{{ $rs->dept_id }}">
                                    {{ $rs->dept_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-success"
                        onclick="
                        Swal.fire({
                            icon: 'question',
                            title: 'ยืนยันดำเนินการ ?',
                            text: '{{ 'REF_ID : '.$data->uuid }}',
                            showCancelButton: true,
                            confirmButtonText: 'ยืนยัน',
                            cancelButtonText: 'ยกเลิก',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit()
                                } else if (result.isDenied) {
                                    form.clear()
                                    }
                                });
                        ">
                        <i class="fa-solid fa-check-circle"></i>
                        ดำเนินการ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Approve -->
<div class="modal fade" id="approve" tabindex="-1" aria-labelledby="approveLabel" aria-hidden="true">
    <form action="{{ route('cmpho.approve',$data->uuid) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveLabel">
                        <i class="fa-solid fa-envelope-circle-check"></i>
                        บันทึกอนุมัติโครงการ
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>วันที่อนุมัติโครงการ</label>
                            <input type="text" name="app_date" class="form-control pickr">
                        </div>
                        <div class="form-group col-md-12">
                            <label>เลขที่หนังสือ</label>
                            <input type="text" name="plan_no" class="form-control" placeholder="ระบุเลขที่หนังสือ">
                        </div>
                        <div class="form-group col-md-12">
                            <label>เลือกไฟล์</label>
                            <input type="file" class="form-control-file" id="file" name="file">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-success"
                        onclick="
                        Swal.fire({
                            icon: 'question',
                            title: 'อนุมัติแผนงานโครงการ ?',
                            text: '{{ 'REF_ID : '.$data->uuid }}',
                            showCancelButton: true,
                            confirmButtonText: 'ยืนยัน',
                            cancelButtonText: 'ยกเลิก',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit()
                                } else if (result.isDenied) {
                                    form.clear()
                                    }
                                });
                        ">
                        <i class="fa-solid fa-check-circle"></i>
                        อนุมัติแผนงานโครงการ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>  
@endsection
@section('script')
<script>
   flatpickr('.pickr', {
        "locale": "th"
    });
</script>
@endsection
