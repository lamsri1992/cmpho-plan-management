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
                @if ($rs->edit > 0)
                    <script>
                        Swal.fire({
                            title: "มีรายการส่งกลับแก้ไข " + '{{ $rs->edit }}' + " รายการ",
                            text: "กรุณาดำเนินการและส่งแผนงานโครงการอีกครั้ง",
                            icon: "warning"
                        });
                    </script>
                @endif
                <div class="col-lg-3 col-6">
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
                <div class="col-lg-3 col-6">
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
                            <p>อยู่ระหว่างดำเนินการ</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-tasks"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner text-white">
                            <h3>{{ number_format($rs->edit) }}</h3>
                            <p>ส่งกลับแก้ไข</p>
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fa-solid fa-edit"></i>
                                แผนงานโครงการรอแก้ไข
                            </h5>
                        </div>
                        <div class="card-body">
                            <table id="basicTable" class="table table-striped table-borderless table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">วันที่</th>
                                        <th class="">แผนงานโครงการ</th>
                                        <th class="text-center">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $rs)
                                    <tr>
                                        <td class="text-center">{{ date("d/m/Y", strtotime($rs->create_at)) }}</td>
                                        <td class="">
                                            <a href="{{ route('plan.view',$rs->uuid) }}">
                                                {{ $rs->plan_name }}
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-danger">
                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                                {{ $rs->p_status_name }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fa-solid fa-chart-line"></i>
                                แผนภูมิแสดงจำนวนเงินแยกตามเงินงบประมาน
                            </h5>
                        </div>
                        <div class="card-body">
                            <canvas id="newChart"></canvas>
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
    flatpickr('.pickr', {
        "locale": "th"
    });

    $(document).ready(function () {
        Chart.defaults.font.family = 'Noto Sans Thai';
    });

    const labels = [
        @foreach ($chart as $res)
        [ "{{ $res->budget_name }}"],
        @endforeach
    ];
  
    const config = {
      type: 'bar',
      data: {
        datasets: [{
            label: 'ยอดเงินงบประมาน',
            data: [
                @foreach ($chart as $res)
                "{{ $res->total }}",
                @endforeach
            ],
            backgroundColor: [
                '#ffc107',
            ],
            borderColor: [
                '#ffc107',
            ],
        }],
        labels: labels
    },
      options: {}
    };

    const newChart = new Chart(
        document.getElementById('newChart'),
        config
    );
</script>
@endsection
