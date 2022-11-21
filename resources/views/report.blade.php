@extends('layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Data Report</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Report</a></li>
                                <li class="breadcrumb-item active">Data Report</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ url('tasks/export') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <h5>Pencari Data</h5>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3" class="col-1 text-end control-label col-form-label">Tgl
                                        Mulai</label>
                                    <div class="col-11 border-start pb-2 pt-2">
                                        <input class="form-control" name="start_at" id="start_at" type="date"
                                            value="{{ old('start_at') }}">

                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3" class="col-1 text-end control-label col-form-label">Tgl
                                        Selesai</label>
                                    <div class="col-11 border-start pb-2 pt-2">
                                        <input class="form-control" name="end_at" id="end_at" type="date"
                                            value="{{ old('end_at') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-0 text-end">
                                    <button type="button" id="btnSearch"
                                        class="btn btn-info rounded-pill px-4 waves-effect waves-light">
                                        <i class="mdi mdi-magnify"></i>Pencarian</button>
                                    <button type="submit"
                                        class="btn btn-success rounded-pill px-4 waves-effect waves-light"> <i
                                            class="mdi mdi-file-excel-box"></i>
                                        Export </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="data-table" class="table table-bordered dt-responsive  nowrap w-100 data-table">
                                <thead>
                                    <tr>
                                        <th>No. Pengajuan</th>
                                        <th>Nama Pelapor</th>
                                        <th>Tgl Mulai</th>
                                        <th>Tgl Selesai</th>
                                        <th>Tentang</th>
                                        <th>Teknisi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
@endsection
@section('js')
    <!-- Required datatable js -->
    <script src="{{ url('assets') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('assets') }}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="{{ url('assets') }}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('assets') }}/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('assets') }}/libs/jszip/jszip.min.js"></script>
    <script src="{{ url('assets') }}/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ url('assets') }}/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{ url('assets') }}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('assets') }}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('assets') }}/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <!-- Responsive examples -->
    <script src="{{ url('assets') }}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('assets') }}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="{{ url('assets') }}/js/pages/datatables.init.js"></script>
    <script src="{{ url('assets') }}/libs/jquery.repeater/jquery.repeater.min.js"></script>

    <script src="{{ url('assets') }}/js/pages/form-repeater.int.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ url()->current() }}",
                    "data": (data) => {
                        data.start_at = $('#start_at').val()
                        data.end_at = $('#end_at').val()
                    }
                },
                columns: [{
                        data: 'task_number',
                        name: 'task_number'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'start_at',
                        name: 'start_at'
                    },
                    {
                        data: 'end_at',
                        name: 'end_at'
                    },

                    {
                        data: 'title',
                        name: 'title'
                    },

                    {
                        data: 'technisianName',
                        name: 'technisianName'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
            $(document).on("click", "#btnSearch", function(e) {
                e.preventDefault()
                table.ajax.reload();

            });
        });
    </script>
@endsection
