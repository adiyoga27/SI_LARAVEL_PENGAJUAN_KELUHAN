<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Sistem Pengajuan Keluhan Penerangan | Kabupaten Kelungkung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta
        content="Sistem Informasi Pengaduan Penerangan Jalan Umum Berbasis Mobile Pada Dinas Perhubungan Kabupaten Klungkung"
        name="description" />
    <meta content="codingaja.com" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('assets') }}/images/logo.png">
    <!-- Sweet Alert-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap Css -->
    <link href="{{ url('assets') }}/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ url('assets') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ url('assets') }}/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    @yield('css')
</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ url('assets') }}/images/logo.svg" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ url('assets') }}/images/logo-dark.png" alt="" height="17">
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ url('assets') }}/images/logo-light.svg" alt="" height="32">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ url('assets') }}/images/logo-light.png" alt="" height="29">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->

                </div>

                <div class="d-flex">
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="{{ url('assets') }}/images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1"
                                key="t-henry">{{ auth()->user()->username }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i
                                    class="bx bx-user font-size-16 align-middle me-1"></i> <span
                                    key="t-profile">Profile</span></a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ url('auth/logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i
                                        class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                                    <span key="t-logout">Logout</span></button>

                            </form>

                        </div>
                    </div>


                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" key="t-menu">Menu</li>

                        <li>
                            <a href="{{ url('/') }}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-dashboards">Dashboard</span>
                            </a>

                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout"></i>
                                <span key="t-layouts">Keluhan</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li>
                                    <a href="{{ route('tasks.pending') }}" key="t-vertical">Pengajuan</a>

                                </li>

                                <li>
                                    <a href="{{ route('tasks.progress') }}" key="t-horizontal">Progress</a>

                                </li>
                                <li>
                                    <a href="{{ route('tasks.history') }}" key="t-horizontal">History</a>

                                </li>
                            </ul>
                        </li>






                        <li>
                            <a href="{{ url('technician') }}" class="waves-effect">
                                <i class="mdi mdi-human-greeting"></i>
                                <span key="mdi-human-greeting">Teknisi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('tasks/schedule') }}" class="waves-effect">
                                <i class="mdi mdi-calendar-clock"></i>
                                <span key="mdi-calendar-clock">Jadwal</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('tasks/report') }}" class="waves-effect">
                                <i class="mdi mdi-book-open-page-variant"></i>
                                <span key="mdi-book-open-page-variant">Laporan</span>
                            </a>
                        </li>



                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">


            @yield('content')

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Skote.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>


    <!-- JAVASCRIPT -->
    <script src="{{ url('assets') }}/libs/jquery/jquery.min.js"></script>
    <script src="{{ url('assets') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('assets') }}/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ url('assets') }}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ url('assets') }}/libs/node-waves/waves.min.js"></script>
    @yield('js')
    <script>
        $(document).ready(function() {


            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: "{{ Session::get('success') }}",
                    showConfirmButton: false,
                    timer: 2500
                });
            @elseif (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ Session::get('error') }}",
                    showConfirmButton: false,
                    timer: 2500
                });
            @elseif (session()->get('errors'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ Session::get('errors')->first() }}",
                    showConfirmButton: false,
                    timer: 2500
                });
            @endif
        });

        function confirmDelete(e, modalSubmit, callback) {
            var isSubmit = modalSubmit === undefined ? true : false;
            // console.log(isSubmit);
            var self = e;
            var deleteMessage = self.getAttribute('data-confirm') ? self.getAttribute('data-confirm') : 'Delete data\ ?';
            Swal.fire({
                icon: 'question',
                title: 'Apakah Anda Yakin?',
                text: deleteMessage,
                showCancelButton: true,
                confirmButtonText: 'Ya, yakin!',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    self.submit();
                } else if (result.isDenied) {
                    callback(true);
                }
            });
        }
    </script>
    <script src="{{ url('assets') }}/js/app.js"></script>




</body>

</html>
