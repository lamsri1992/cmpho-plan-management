@extends('app.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('plan.list') }}">
                                <i class="fa-solid fa-folder-open"></i> 
                                แผนงานโครงการ
                            </a>
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
                            <h5 class="card-title">
                                <i class="fa-regular fa-clipboard"></i>
                                ข้อมูลแผนงานโครงการ
                            </h5>
                        </div>
                        <form action="{{ route('plan.update',$data->uuid) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                <i class="far fa-file"></i>
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
                                                <i class="far fa-file-alt"></i>
                                                เลขที่หนังสือ
                                            </label>
                                            <input type="text" name="plan_doc_no" class="form-control" value="{{ $data->plan_doc_no }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="far fa-calendar-check"></i>
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
                                            <input type="text" class="form-control" value="{{ $data->plan_receive }}" @readonly(true)>
                                        </div>
                                    </div>
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
                                    @if ($data->p_status_id == 1)
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success"
                                            onclick="
                                                Swal.fire({
                                                    icon: 'question',
                                                    title: 'ยืนยันการแก้ไขแผนงานโครงการ ?',
                                                    text: '{{ 'REF_ID : '.$data->uuid }}',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'แก้ไขแผนงานโครงการ',
                                                    cancelButtonText: 'ยกเลิก',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        form.submit()
                                                    } else if (result.isDenied) {
                                                        form.clear()
                                                }
                                                });
                                            ">
                                            <i class="fa-regular fa-save"></i>
                                            บันทึกข้อมูล
                                        </button>
                                    </div>
                                    @endif
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
                </div>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
@section('script')
<script>
    flatpickr('.pickr', {
        "locale": "th"
    });
</script>
@endsection
