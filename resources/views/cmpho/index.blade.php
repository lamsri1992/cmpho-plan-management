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
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ number_format($rs->total) }}</h3>
                            <p>รายการทั้งหมด</p>
                        </div>
                        <div class="icon">
                            <i class="fa-regular fa-clipboard"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ number_format($rs->approve) }}</h3>
                            <p>อนุมัติแล้ว</p>
                        </div>
                        <div class="icon">
                            <i class="fa-regular fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
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
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ number_format($rs->progress) }}</h3>
                            <p>กำลังดำเนินการ</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-tasks"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ number_format($rs->edit) }}</h3>
                            <p>รอแก้ไข</p>
                        </div>
                        <div class="icon">
                            <i class="fa-regular fa-edit"></i>
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
                            <table id="dtFilter" class="table table-striped table-borderless table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">วันที่</th>
                                        <th class="text-center">หน่วยบริการ</th>
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
                                        <td class="text-center">{{ $rs->h_name }}</td>
                                        <td class="">{{ $rs->plan_name }}</td>
                                        <td class="text-center">{{ $rs->budget_name }}</td>
                                        <td class="text-right">{{ number_format($rs->plan_total,2) }}</td>
                                        <td class="text-center {{ $rs->p_status_color }}">
                                            {{ $rs->p_status_name }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('cmpho.view',$rs->uuid) }}" class="btn btn-default btn-sm">
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
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.select2-filter').select2({
            width: '100%',
        });
    });
    new DataTable('#dtFilter', {
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
            .columns([1,3,5])
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
