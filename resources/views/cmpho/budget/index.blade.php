@extends('app.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">ข้อมูลแหล่งงบประมาณ</li>
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
                                <i class="fa-solid fa-comments-dollar"></i>
                                ข้อมูลแหล่งงบประมาณ
                            </h5>
                        </div>
                        <div class="card-body">
                            <table id="list_table" class="table table-striped table-borderless table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="">ชื่อแหล่งงบประมาณ</th>
                                        <th class="text-center"><i class="fa-solid fa-bars"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $rs)
                                        <tr>
                                            <td class="text-center">{{ $rs->budget_id }}</td>
                                            <td class="">{{ $rs->budget_name }}</td>
                                            <td class="text-center">
                                                <input type="checkbox" class="switchClick"
                                                    data-toggle="toggle"
                                                    data-onstyle="success"
                                                    data-size="sm"
                                                    data-on="<i class='fa-solid fa-check-circle'></i> เปิดใช้งาน" 
                                                    data-off="<i class='fa-solid fa-xmark-circle text-danger'></i> ปิดใช้งาน"
                                                    data-id="{{ $rs->budget_id }}"
                                                    data-name="{{ $rs->budget_name }}"
                                                    {{ ($rs->budget_status == 1) ? 'checked':'' }}
                                                >
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
<div class="modal fade" id="addBudget" tabindex="-1" aria-labelledby="addBudgetLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('cmpho.budget.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBudgetLabel">
                        <i class="fa-solid fa-circle-plus text-primary"></i>
                        เพิ่มแหล่งงบประมาณ
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">ชื่อแหล่งงบประมาณ</label>
                        <input type="text" name="budget_name" class="form-control" placeholder="ชื่อแหล่งงบประมาณ">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-success"
                    onclick="
                        Swal.fire({
                            icon: 'question',
                            title: 'ยืนยันเพิ่มแหล่งงบประมาณ ?',
                            showCancelButton: true,
                            confirmButtonText: 'เพิ่มแหล่งงบประมาณ',
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
                        text: '<i class="fa-solid fa-plus-circle text-primary"></i> เพิ่มแหล่งงบประมาณ',
                        action: function (e, dt, node, config) {
                            $('#addBudget').modal('show')
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

    $(document).on('change', '.switchClick', function(e) {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        var token = "{{ csrf_token() }}";
        // alert(id + '\n' +name)
        e.preventDefault();

        var Toast = Swal.mixin({
            position: 'top-end',
            toast: true,
            showConfirmButton: false,
            timer: 3000
        });

        $.ajax({
            url: "{{ route('cmpho.budget.changed') }}",
            method: "GET",
            data: {
                id: id,
                _token: token
            },
            success: function (data) {
                Toast.fire({
                    icon: 'success',
                    title: 'ปรับปรุงสถานะ\n'+name,
                });
            }
        });
    });
</script>
@endsection
