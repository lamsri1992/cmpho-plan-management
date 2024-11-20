@extends('app.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">ข้อมูลกลุ่มงาน สสจ.เชียงใหม่</li>
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
                                <i class="fa-solid fa-sitemap"></i>
                                ข้อมูลกลุ่มงาน สสจ.เชียงใหม่
                            </h5>
                        </div>
                        <div class="card-body">
                            <table id="list_table" class="table table-striped table-borderless table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="">ชื่อกลุ่มงาน</th>
                                        <th class="text-center"><i class="fa-solid fa-bars"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $rs)
                                        <tr>
                                            <td class="text-center">{{ $rs->dept_id }}</td>
                                            <td class="">{{ $rs->dept_name }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('cmpho.department.show',$rs->dept_id) }}" class="btn btn-xs btn-info">
                                                    <i class="fa-solid fa-search"></i>
                                                    รายละเอียด
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal fade" id="addDepartment" tabindex="-1" aria-labelledby="addDepartmentLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('cmpho.department.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDepartmentLabel">
                        <i class="fa-solid fa-user-plus text-primary"></i>
                        เพิ่มกลุ่มงาน
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">ชื่อกลุ่มงาน</label>
                        <input type="text" name="dept_name" class="form-control" placeholder="ชื่อกลุ่มงาน">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-success"
                    onclick="
                        Swal.fire({
                            icon: 'question',
                            title: 'ยืนยันเพิ่มกลุ่มงาน ?',
                            showCancelButton: true,
                            confirmButtonText: 'เพิ่มกลุ่มงาน',
                            cancelButtonText: 'ยกเลิก',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                        form.submit()
                                    } else if (result.isDenied) {
                                        form.clear()
                                    }
                                });
                            ">
                        <i class="fa-solid fa-circle-plus"></i>
                        บันทึกข้อมูล
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    new DataTable('#list_table', {
        layout: {
            topStart: {
                buttons: [
                    {
                        text: '<i class="fa-solid fa-plus-circle text-primary"></i> เพิ่มกลุ่มงาน',
                        action: function (e, dt, node, config) {
                            $('#addDepartment').modal('show')
                        }
                    },
                ]
            }
        },
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,
        // scrollX: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        oLanguage: {
            oPaginate: {
                sFirst: '<small>หน้าแรก</small>',
                sLast: '<small>หน้าสุดท้าย</small>',
                sNext: '<small>ถัดไป</small>',
                sPrevious: '<small>กลับ</small>'
            },
            sSearch: '<small><i class="fa fa-search"></i> ค้นหา</small>',
            sInfo: '<small>ทั้งหมด _TOTAL_ รายการ</small>',
            sLengthMenu: '<small>แสดง _MENU_ รายการ</small>',
            sInfoEmpty: '<small>ไม่มีข้อมูล</small>'
        }
    });
</script>
@endsection
