@extends('app.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('cmpho.hospital.index') }}">
                                ข้อมูลหน่วยบริการ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $data->h_code }}</li>
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
                                {{ $data->h_name }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cmpho.hospital.update',$data->h_id) }}"
                                method="POST">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">รหัสหน่วยบริการ</label>
                                        <input type="text" name="h_code" class="form-control" placeholder="รหัสหน่วยบริการ"
                                            value="{{ $data->h_code }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">หน่วยบริการ</label>
                                        <input type="text" name="h_name" class="form-control"
                                            placeholder="ชื่อหน่วยบริการ" value="{{ $data->h_name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">ประเภทหน่วยบริการ</label>
                                        <select name="h_type" class="single-select">
                                            <option></option>
                                            @foreach($type as $rs)
                                                <option value="{{ $rs->h_type_id }}"
                                                    {{ $data->h_type == $rs->h_type_id ? 'SELECTED':'' }}>
                                                    {{ $rs->h_type_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-success" onclick="
                                            Swal.fire({
                                                icon: 'question',
                                                title: 'แก้ไขข้อมูลหน่วยบริการ ?',
                                                text: '{{ $data->h_name }}',
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
<script>
    $(document).ready(function () {
        $('.single-select').select2({
            width: '100%',
            placeholder: 'กรุณาเลือกข้อมูล'
        });
    });

</script>
@endsection
