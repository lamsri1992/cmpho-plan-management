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
                            <i class="far fa-clipboard"></i>
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
                            <i class="fas fa-tasks"></i>
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
                            <i class="fas fa-paper-plane"></i>
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
                            <i class="far fa-check-circle"></i>
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
                            <h5 class="card-title">Card title</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                Some quick example text to build on the card title and make up the bulk of the card's
                                content.
                            </p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Card title</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                Some quick example text to build on the card title and make up the bulk of the card's
                                content.
                            </p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
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
