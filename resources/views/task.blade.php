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
                        <h4 class="mb-sm-0 font-size-18">Data Pengajuan Task</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Task</a></li>
                                <li class="breadcrumb-item active">Data Pengajuan</li>
                            </ol>
                        </div>

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
                                        <th>Desa</th>
                                        <th>Nik</th>
                                        <th>Nama</th>
                                        <th>Tentang</th>
                                        <th>Status</th>

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


    <div class="modal fade" id="modal_reject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Form Tolak Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-reject" class="form-reject" method="POST">
                    <div class="modal-body">

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Alasan</label>
                            <div class="col-md-10">
                                <input name="id" id="id" hidden>

                                <textarea class="form-control" name="reject_note" id="reject_note"> </textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_approve" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Form Terima Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="repeater form-approve" enctype="multipart/form-data" id="form-approve">
                    <div class="modal-body">
                        <input name="approve_id" id="approve_id" hidden>
                        <div data-repeater-list="listTechnician">
                            <div data-repeater-item class="row">
                                <div class="col-md-10 col-8 mt-2">
                                    <label for="name">Teknisi</label>
                                    <select class="inner form-control technician" name="technician">
                                        <option value="">Pilih Teknisi</option>
                                    </select>
                                </div>


                                <div class="col-md-2 col-4  mt-2">
                                    <div class="d-grid">
                                        <label for="name"><br></label>

                                        <input data-repeater-delete type="button" class="btn btn-primary" value="Delete" />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <br>
                        <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0 addBtn"
                            value="Add" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                {{-- <form id="form-approve" class="outer-repeater form-approve">
                    <div class="modal-body">

                        <input name="approve_id" id="approve_id">

                        <div data-repeater-list="outer-group" class="outer">
                            <div data-repeater-item class="outer">


                                <div class="inner-repeater mb-4">
                                    <div data-repeater-list="inner-group" class="inner mb-3">
                                        <label>Teknisi</label>
                                        <div data-repeater-item class="inner mb-3 row">
                                            <div class="col-md-10 col-8">
                                                <select class="inner form-control technician" name="technician">
                                                    <option value="">Pilih Teknisi</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-4">
                                                <div class="d-grid">
                                                    <button data-repeater-delete type="button"
                                                        class="btn btn-danger inner"> <i class="mdi mdi-delete-sweep"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <button data-repeater-create type="button" class="btn btn-success inner"><i
                                            class="mdi mdi-account-plus"></i></button>
                                </div>


                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form> --}}

            </div>
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
        $(function() {
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url()->current() }}",
                columns: [{
                        data: 'task_number',
                        name: 'task_number'
                    },
                    {
                        data: 'complaint_village',
                        name: 'complaint_village'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },


                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, full, meta) {
                            if (data == 'success') {
                                return "<span class='badge bg-success'>Selesai</span>";
                            } else if (data == 'progress') {
                                return "<span class='badge bg-info'>Sedang Berjalan</span>";
                            } else if (data == 'pending') {
                                return "<span class='badge bg-danger'>Dalam Antrian</span>";
                            }
                            return "<span class='badge bg-danger'>Tolak</span>";
                        }
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        });
        technician();

        $('#modal_reject').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            // Isi nilai pada field

            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            // Isi nilai pada field
            var id = div.data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('tasks') }}/" + id,
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response.data[0])
                    if (response.status) {
                        modal.find('#id').val(response.data['id']);
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal Menyimpan Data',
                            'error'
                        )
                    }

                }
            });
        });

        $('#modal_approve').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            // Isi nilai pada field

            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            // Isi nilai pada field
            var id = div.data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('tasks') }}/" + id,
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response.data[0])
                    if (response.status) {
                        modal.find('#approve_id').val(response.data['id']);
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal Menyimpan Data',
                            'error'
                        )
                    }

                }
            });
        });



        $("#form-reject").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var id = $('#id').val();
            $.ajax({
                type: "POST",
                url: "{{ url('tasks/reject/') }}/" + id,
                data: data,
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status) {
                        Swal.fire(
                            'Berhasil',
                            'Berhasil Di Simpan',
                            'success'
                        ).then((result) => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal Menyimpan Data',
                            'error'
                        )
                    }
                }
            });
        });

        $("#form-approve").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var id = $("input[name=approve_id]").val();
            $.ajax({
                type: "POST",
                url: "{{ url('tasks/approve/') }}/" + id,
                data: data,
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status) {
                        Swal.fire(
                            'Berhasil',
                            'Berhasil Di Simpan',
                            'success'
                        ).then((result) => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal Menyimpan Data',
                            'error'
                        )
                    }
                }
            });
        });

        $('.addBtn').click(function() {
            technician();
        });

        function technician() {
            $.ajax({
                type: "GET",
                url: "{{ url('get-technician') }}",
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status) {
                        response.data.forEach(element => {
                            $('.technician').append("<option value='" + element['id'] + "'>" +
                                element['name'] + "</option>")

                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal Menyimpan Data',
                            'error'
                        )
                    }
                }
            });
        }
    </script>
@endsection
