@extends('app.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('cmpho.department.index') }}">
                                ข้อมูลกลุ่มงาน สสจ.เชียงใหม่
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $data->dept_name }}</li>
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
                                {{ $data->dept_name }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cmpho.department.update',$data->dept_id) }}" method="POST">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">กลุ่มงาน</label>
                                        <input type="text" name="dept_name" class="form-control"
                                            placeholder="ชื่อกลุ่มงาน" value="{{ $data->dept_name }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-success" 
                                        onclick="
                                            Swal.fire({
                                                icon: 'question',
                                                title: 'แก้ไขข้อมูลกลุ่มงาน ?',
                                                text: '{{ $data->dept_name }}',
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
@endsection
