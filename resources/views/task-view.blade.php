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

                            <div class="card-body">

                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3"
                                        class="col-2 text-end control-label col-form-label">Desa</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        <input type="text" name="title" class="form-control" id="inputEmail3"
                                            value="{{ !empty($task) ? $task->complaint_village : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3" class="col-2 text-end control-label col-form-label">NIK</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        <input type="text" name="title" class="form-control" id="inputEmail3"
                                            value="{{ !empty($task) ? $task->nik : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3"
                                        class="col-2 text-end control-label col-form-label">Nama</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        <input type="text" name="title" class="form-control" id="inputEmail3"
                                            value="{{ !empty($task) ? $task->name : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3" class="col-2 text-end control-label col-form-label">HP</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        <input type="text" name="title" class="form-control" id="inputEmail3"
                                            value="{{ !empty($task) ? $task->hp : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3"
                                        class="col-2 text-end control-label col-form-label">Title</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        <input type="text" name="title" class="form-control" id="inputEmail3"
                                            value="{{ !empty($task) ? $task->title : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3"
                                        class="col-2 text-end control-label col-form-label">Deskripsi</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        <input type="text" name="title" class="form-control" id="inputEmail3"
                                            value="{{ !empty($task) ? $task->title : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3"
                                        class="col-2 text-end control-label col-form-label">Status</label>
                                    <div class="col-9 border-start pb-2 pt-2">
                                        <input type="text" name="title" class="form-control" id="inputEmail3"
                                            value="{{ !empty($task) ? $task->status : '' }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-0 text-end">
                                    <a href="{{ URL::previous() }}"
                                        class="btn btn-dark rounded-pill px-4 waves-effect waves-light">Cancel</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
    </div>
@endsection
