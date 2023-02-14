@extends('layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li> --}}
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <!-- end row -->

            <div class="row">
                <div class="col-xl-4">
                    <div class="card bg-primary bg-soft">
                        <div>
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-3">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p>{{ auth()->user()->name }}<br> ( Administrator )</p>
                                        <br>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ url('assets') }}/images/profile-img.png" alt="" class="img-fluid"
                                        style="height: 100px !important">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-3">
                                            <span
                                                class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                <i class="bx bx-archive-in"></i>
                                            </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Selesai</h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h4>{{ $success }} Tasks <i class=" ms-1 text-success"></i></h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-3">
                                            <span
                                                class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                <i class="bx bx-copy-alt"></i>
                                            </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Sedang Diperbaiki</h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h4>{{ $progress }} Tasks <i class=" ms-1 text-success"></i></h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-3">
                                            <span
                                                class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                <i class="bx bx-purchase-tag-alt"></i>
                                            </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Belum Ditanggapi</h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h4>{{ $pending }} Tasks <i class="ms-1 text-success"></i></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>


            <!-- end row -->

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Grafik Pengajuan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li> --}}
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <!-- end row -->
            <div style="width:50%">
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {!! json_encode($charts) !!},
            options: {}
        });
    </script>
@endsection
@section('js')
    <!-- apexcharts -->
    <script src="{{ url('assets') }}/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Saas dashboard init -->
    <script src="{{ url('assets') }}/js/pages/saas-dashboard.init.js"></script>
@endsection
