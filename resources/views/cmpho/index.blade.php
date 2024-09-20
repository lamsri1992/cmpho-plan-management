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
                            <p>รายการทั้งหมด</p>
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
                            <p>รอตรวจสอบ</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-tasks"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-3">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ number_format($rs->progress) }}</h3>
                            <p>รอนำส่ง</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-paper-plane"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-3">
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
                            <table id="basicTable" class="table table-striped table-borderless table-bordered nowrap" style="width:100%">
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
                                        <td class="text-center">
                                            <span class="{{ $rs->p_status_color }}">
                                                {!! $rs->p_status_icon !!}
                                            </span>
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

@endsection
