@extends('app.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('cmpho.user.index') }}">
                                จัดการผู้ใช้งาน
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $data->uuid }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fa-solid fa-user-edit"></i>
                                {{ $data->name }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cmpho.user.update',$data->uuid) }}" method="POST">
                                @csrf
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">ชื่อผู้ใช้งาน</label>
                                            <input type="text" name="name" class="form-control" placeholder="ชื่อผู้ใช้งาน" value="{{ $data->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">บัญชีผู้ใช้งาน</label>
                                            <input type="email" name="email" class="form-control" placeholder="ชื่อหน่วยบริการ@รหัสหน่วยบริการ" value="{{ $data->email }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">หน่วยงาน</label>
                                            <select name="department" class="single-select">
                                                <option></option>
                                                @foreach ($dept as $rs)
                                                <option value="{{ $rs->dept_id }}"
                                                    {{ $data->department_id == $rs->dept_id ? 'SELECTED':'' }}>
                                                    {{ $rs->dept_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">หน่วยบริการ</label>
                                            <select name="hcode" class="single-select">
                                                <option></option>
                                                @foreach ($hosp as $rs)
                                                <option value="{{ $rs->h_code }}"
                                                    {{ $data->hcode == $rs->h_code ? 'SELECTED':'' }}>
                                                    {{ $rs->h_code." - ".$rs->h_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">สิทธิการใช้งาน</label>
                                            <select name="role" class="single-select">
                                                <option></option>
                                                @foreach ($role as $rs)
                                                <option value="{{ $rs->role_id }}"
                                                    {{ $data->role == $rs->role_id ? 'SELECTED':'' }}>
                                                    {{ $rs->role_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success"
                                        onclick="
                                            Swal.fire({
                                                icon: 'question',
                                                title: 'แก้ไขข้อมูลผู้ใช้งานระบบ ?',
                                                text: '{{ $data->uuid }}',
                                                showCancelButton: true,
                                                confirmButtonText: 'แก้ไขข้อมูล',
                                                cancelButtonText: 'ยกเลิก',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                            form.submit()
                                                        } else if (result.isDenied) {
                                                            form.clear()
                                                        }
                                                    });
                                                ">
                                            <i class="fa-solid fa-save"></i>
                                            บันทึกข้อมูล
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.single-select').select2({
            width: '100%',
            placeholder: 'กรุณาเลือกข้อมูล'
        });
    });
</script>
@endsection
