@extends('app.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach ($count as $rs)
                <div class="col-lg-3 col-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ number_format($rs->total) }}</h3>
                            <p>แผนงานโครงการทั้งหมด</p>
                        </div>
                        <div class="icon">
                            <i class="fa-regular fa-clipboard"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-3">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ number_format($rs->wait) }}</h3>
                            <p>รอดำเนินการ</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-3">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ number_format($rs->progress) }}</h3>
                            <p>อยู่ระหว่างดำเนินการ</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-tasks"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ number_format($rs->approve) }}</h3>
                            <p>ผ่านการอนุมัติแล้ว</p>
                        </div>
                        <div class="icon">
                            <i class="fa-regular fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                @endforeach
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
                            <table id="dataTable" class="table table-striped table-borderless table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">วันที่</th>
                                        <th class="">แผนงานโครงการ</th>
                                        <th class="text-center">แหล่งงบประมาณ</th>
                                        <th class="text-right">จำนวนเงิน</th>
                                        <th class="text-center">สถานะ</th>
                                        <th class="text-center"><i class="fa-solid fa-bars"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $rs)
                                    <tr>
                                        <td class="text-center">{{ date("d/m/Y", strtotime($rs->create_at)) }}</td>
                                        <td class="">{{ $rs->plan_name }}</td>
                                        <td class="text-center">{{ $rs->budget_name }}</td>
                                        <td class="text-right">{{ number_format($rs->plan_total,2) }}</td>
                                        <td class="text-center">
                                            <span class="{{ $rs->p_status_color }}">
                                                {!! $rs->p_status_icon !!}
                                            </span>
                                            {{ $rs->p_status_name }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('plan.view',$rs->uuid) }}" class="btn btn-default btn-sm">
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
<div class="modal fade" id="addList" tabindex="-1" aria-labelledby="addListLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('plan.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addListLabel">
                        <i class="fa-solid fa-plus-circle text-success"></i>
                        สร้างแผนงานโครงการ
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>ชื่อโครงการ</label>
                            <input type="text" name="plan_name" class="form-control" placeholder="กรุณาระบุชื่อแผนงานโครงการ">
                        </div>
                        <div class="form-group col-md-6">
                            <label>แหล่งงบประมาณ</label>
                            <select name="plan_budget_id" class="basic-single">
                                <option></option>
                                @foreach ($budget as $rs)
                                <option value="{{ $rs->budget_id }}">
                                    {{ $rs->budget_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>จำนวนเงิน</label>
                            <input type="text" name="plan_total" class="form-control" placeholder="ระบุเป็นตัวเลข">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-success"
                        onclick="
                            Swal.fire({
                                icon: 'success',
                                title: 'ยืนยันการสร้างแผนงานโครงการใหม่ ?',
                                showCancelButton: true,
                                confirmButtonText: 'สร้างแผนงานโครงการ',
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
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    new DataTable('#dataTable', {
        layout: {
            topStart: {
                buttons: [
                    {
                        text: '<i class="fa-solid fa-plus-circle text-success"></i> สร้างแผนงานโครงการ',
                        action: function (e, dt, node, config) {
                            $('#addList').modal('show')
                        }
                    }
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
    });
</script>
@endsection
