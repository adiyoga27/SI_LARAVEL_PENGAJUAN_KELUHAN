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
                    <h4 class="mb-sm-0 font-size-18">Detail Pengajuan Task</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Task</a></li>
                            <li class="breadcrumb-item ">Data</li>
                            <li class="breadcrumb-item active">Detail Pengajuan</li>

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
                        <form action="{{url('tasks/finish/'.$task->id)}}" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3" class="col-2 text-end control-label col-form-label">Desa</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        <input type="text" name="title" class="form-control" id="inputEmail3" value="{{ !empty($task) ? $task->complaint_village : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3" class="col-2 text-end control-label col-form-label">NIK</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        <input type="text" name="title" class="form-control" id="inputEmail3" value="{{ !empty($task) ? $task->nik : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3" class="col-2 text-end control-label col-form-label">Nama</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        <input type="text" name="title" class="form-control" id="inputEmail3" value="{{ !empty($task) ? $task->name : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3" class="col-2 text-end control-label col-form-label">HP</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        <input type="text" name="title" class="form-control" id="inputEmail3" value="{{ !empty($task) ? $task->hp : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3" class="col-2 text-end control-label col-form-label">Title</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        <input type="text" name="title" class="form-control" id="inputEmail3" value="{{ !empty($task) ? $task->title : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3" class="col-2 text-end control-label col-form-label">Deskripsi</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        <textarea readonly name="description" class="form-control" id="inputEmail3" readonly>{{ !empty($task) ? $task->description : '' }}</textarea>

                                    </div>
                                </div>
                                <!-- <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3"
                                        class="col-2 text-end control-label col-form-label">Status</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        <input type="text" name="title" class="form-control" id="inputEmail3"
                                            value="{{ !empty($task) ? $task->status : '' }}" readonly>
                                    </div>
                                </div> -->

                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3" class="col-2 text-end control-label col-form-label">Foto</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        @foreach($task->images as $image)
                                        <img src="{{ url('storage/' . $image->url) }}" alt="" width="100px">
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3" class="col-2 text-end control-label col-form-label">Maps</label>
                                    <div class="col-9 border-start pb-2 pt-2">

                                        <div id="gmaps-markers" class="gmaps"></div>
                                    </div>
                                </div>
                                @if($task->status <> 'pending')

                                    <div class="form-group row align-items-center mb-0">
                                        <label for="inputEmail3" class="col-2 text-end control-label col-form-label">Teknisi</label>
                                        <div class="col-9 border-start pb-2 pt-2">
                                            <table id="data-table" class="table table-bordered dt-responsive  nowrap w-100 data-table">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <!-- <th>Status</th> -->

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($task->technician as $tech)
                                                    <tr height="35px">

                                                        <td>
                                                            {{$tech->technician->name}}
                                                        </td>
                                                        <!-- <td>
                                            
                                            </td> -->
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif


                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if($task->status == 'reject')
                        <div class="form-group row align-items-center mb-0">
                            <label for="inputEmail3" class="col-2 text-end control-label col-form-label">Note Reject</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <textarea class="form-control" name="reject_note" id="reject_note">{{ !empty($task) ? $task->reject_note : '' }}</textarea>

                            </div>
                        </div>
                        @endif
                        @if($task->status == 'success' || $task->status == 'progress' )
                        <div class="form-group row align-items-center mb-0">
                            <label for="inputEmail3" class="col-2 text-end control-label col-form-label">Note Finish</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <textarea class="form-control" name="finish_note" id="finish_note">{{ !empty($task) ? $task->finish_note : '' }}</textarea>

                            </div>
                        </div>
                        @endif
                        <br>

                        <div class="form-group mb-0 text-end">
                            @if($task->status == 'pending')
                            <a class="btn btn-success rounded-pill px-4 waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#approveModal" id="btnApprove"><i class="mdi mdi-checkbox-marked-outline"> </i>Terima</a>
                            <a class="btn btn-danger rounded-pill px-4 waves-effect waves-light btnTolak" id="btnTolak" data-id="{{$task->id}}"><i class="mdi mdi-close-box-outline"> </i>Tolak</a>
                            @endif
                            @if($task->status == 'progress')
                            <button type="submit" class="btn btn-success rounded-pill px-4 waves-effect waves-light"><i class="mdi mdi-checkbox-marked-outline"> </i>Selesai</button>
                            @endif

                            <a href="{{ URL::previous() }}" class="btn btn-dark rounded-pill px-4 waves-effect waves-light">Cancel</a>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
</div>

<!-- sample modal content -->
<div id="approveModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Pilih Teknisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('tasks/approve/'.$task->id)}}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Silahakn isi data schedule :</p>

                    <div class="form-group row align-items-center mb-0">
                        <label for="inputEmail3" class="col-2 text-end control-label col-form-label">Tgl Mulai</label>
                        <div class="col-9 border-start pb-2 pt-2">
                            <input name="start_date" type="date" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row align-items-center mb-0">
                        <label for="inputEmail3" class="col-2 text-end control-label col-form-label">Tgl Selesai</label>
                        <div class="col-9 border-start pb-2 pt-2">
                            <input name="end_date" type="date" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <p>Pilih Petugas</p>
                    <div class="content" id="content"></div>
                    <table id="data-table" class="table table-bordered dt-responsive  nowrap w-100 data-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($technicians as $technician)
                            <tr height="35px">
                                <td width="35px">
                                    <input class="form-check-input" type="checkbox" id="formCheck1" name="listTechnician[]" value="{{$technician->id}}">
                                </td>
                                <td>
                                    {{$technician->name}}
                                </td>
                                <td>
                                    @if($technician->onProgressTask->count() > 0)
                                    <span class='badge bg-danger'>{{$technician->onProgressTask->count()}} Task</span>
                                    @else
                                    <span class='badge bg-success'>Tidak Ada Task</span>

                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan Schedule</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('js')
<script src="https://maps.google.com/maps/api/js?key={{\config('gmap.gmap_api_key')}}"></script>
<script src="{{ url('assets') }}/libs/gmaps/gmaps.min.js"></script>

<script>
    var map;
    $(document).ready(

        function() {
            (
                map = new GMaps({
                    div: "#gmaps-markers",
                    lat: <?php echo $task->latitude ?>,
                    lng: <?php echo $task->longtitude ?>
                })).addMarker({
                lat: <?php echo $task->latitude ?>,
                lng: <?php echo $task->longtitude ?>,
                title: "Lima",
                details: {
                    database_id: 42,
                    author: "HPNeo"
                },
                // click: function(a) {
                //     console.log && console.log(a),
                //         alert("You clicked in this marker")
                // }
            })
        }


    );
    $("#btnApprove").on("click", function() {
        $('#approveModal').modal('show');
        $('#approveModal').on('shown.bs.modal', function() {
            $('#content').find('.modal-body').append('<p>append some html here</p>');
        });
    });
    $("#btnTolak").on("click", function() {
        Swal.fire({
            icon: 'question',
            title: 'Alasan Kamu Menolak Pengajuan Ini?',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Tolak',
            showLoaderOnConfirm: true,
            preConfirm: (note) => {
                $.ajax({
                    url: "{{url('tasks/reject/'.$task->id)}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json'
                    },
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        reject_note: note,
                    },
                    success: function(data) {
                        if (data.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: data.message,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.history.back();
                                }
                            })
                            return;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Warning',
                            text: data.message,
                        });
                        return;
                    }
                });

            },
            allowOutsideClick: () => !Swal.isLoading()
        })
    });
</script>
@endsection