@extends('app.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">ข้อมูลผู้ใช้งาน</li>
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
                                <i class="fa-regular fa-clipboard"></i>
                                แผนงานโครงการ
                            </h5>
                        </div>
                        <div class="card-body">
                            <table id="list_table" class="table table-striped table-borderless table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="">ชื่อผู้ใช้งาน</th>
                                        <th class="">บัญชีผู้ใช้งาน</th>
                                        <th class="">หน่วยบริการ</th>
                                        <th class="text-center">สิทธิการใช้งาน</th>
                                        <th class="text-center"><i class="fa-solid fa-bars"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $rs)
                                        <tr>
                                            <td class="text-center">{{ $rs->id }}</td>
                                            <td class="">{{ $rs->name }}</td>
                                            <td class="">{{ $rs->email }}</td>
                                            <td class="">{{ $rs->hcode." : ".$rs->h_name }}</td>
                                            <td class="text-center">{{ $rs->role_name }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('cmpho.user.show',$rs->uuid) }}" class="btn btn-xs btn-info">
                                                    <i class="fa-solid fa-search"></i>
                                                    รายละเอียด
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-center">
                                            <i class="fa-solid fa-filter"></i>
                                            Filter
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('cmpho.user.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserLabel">
                        <i class="fa-solid fa-user-plus text-primary"></i>
                        เพิ่มผู้ใช้งาน
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">ชื่อผู้ใช้งาน</label>
                        <input type="text" name="name" class="form-control" placeholder="ชื่อผู้ใช้งาน">
                    </div>
                    <div class="form-group">
                        <label for="">บัญชีผู้ใช้งาน</label>
                        <input type="email" name="email" class="form-control" placeholder="ชื่อหน่วยบริการ@รหัสหน่วยบริการ">
                    </div>
                    <div class="form-group">
                        <label for="">หน่วยงาน</label>
                        <select name="department" class="single-select">
                            <option></option>
                            @foreach ($dept as $rs)
                            <option value="{{ $rs->dept_id }}">
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
                            <option value="{{ $rs->h_code }}">
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
                            <option value="{{ $rs->role_id }}">
                                {{ $rs->role_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-success"
                    onclick="
                        Swal.fire({
                            icon: 'question',
                            title: 'ยืนยันเพิ่มผู้ใช้งานระบบ ?',
                            text: 'รหัสผ่านเริ่มต้น = รหัสหน่วยบริการ',
                            showCancelButton: true,
                            confirmButtonText: 'เพิ่มผู้ใช้งานระบบ',
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
    $(document).ready(function() {
        $('.single-select').select2({
            width: '100%',
            placeholder: 'กรุณาเลือกข้อมูล',
            dropdownParent: $("#addUser")
        });
    });

    $(document).ready(function() {
        $('.select2-filter').select2({
            width: '100%',
        });
    });
    new DataTable('#list_table', {
        layout: {
            topStart: {
                buttons: [
                    {
                        text: '<i class="fa-solid fa-user-plus text-primary"></i> เพิ่มผู้ใช้งาน',
                        action: function (e, dt, node, config) {
                            $('#addUser').modal('show')
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
        },
        initComplete: function () {
            this.api()
            .columns([3,4])
            .every(function () {
                var column = this;
                var select = $(
                    '<select class="select2-filter" style="width:100%;"><option value="">ทั้งหมด</option></select>'
                )
                .appendTo($(column.footer()).empty())
                .on('change', function () {
                    var val = DataTable.util.escapeRegex($(this).val());
                    column
                    .search(val ? '^' + val + '$' : '', true, false)
                    .draw();
                });
                column
                .data()
                .unique()
                .sort()
                .each(function (d, j) {
                    select.append(
                        '<option class="select2-filter" value="' + d + '">' + d + '</option>'
                    );
                });
            });
        }
    });
</script>
@endsection
