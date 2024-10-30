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
