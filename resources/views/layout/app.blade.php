<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pagetitle')</title>
    <meta>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    {{-- Bootstrap 5 --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <!-- DataTables CSS -->
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css"> --}}
    <link rel="stylesheet" href="DataTables\datatables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- DataTables JS -->
    <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <div class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <div class="">Current Date and Time:</div>
                    <p id="current-date"></p>
                </li>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">
                <img src="icons/webLogo.png" alt="NOMCAARRD Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="fluid brand-text info font-weight-light d-block">NOMCAARRD WEBSIMS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }} " class="nav-link">
                                <div class="nav-icon fas fa-tachometer-alt"></div>
                                <p>
                                    DASHBOARD
                                </p>
                            </a>
                        </li>

                        {{-- This navigation area for Items --}}
                        <li class="nav-item">
                            <a href="{}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    USER MANAGEMENT
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('employees') }}" class="nav-link">
                                        <i class="fas nav-icon fa-user"></i>
                                        <p>EMPLOYEE</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('users') }}" class="nav-link">
                                        <i class="far nav-icon fa-user"></i>
                                        <p>USERS</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    ITEMS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('equipments') }}" class="nav-link">
                                        <i class="far nav-icon"></i>
                                        <p>EQUIPMENTS</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('supplies') }}" class="nav-link">
                                        <i class="far nav-icon"></i>
                                        <p>SUPPLIES</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('categories') }}" class="nav-link">
                                        <i class="far nav-icon"></i>
                                        <p>CATEGORY</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>
                                    REPORTS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('equipmentReport') }}" class="nav-link">
                                        <i class="far nav-icon"></i>
                                        <p>EQUIPMENTS REPORT</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('supplyReport') }}" class="nav-link">
                                        <i class="far nav-icon"></i>
                                        <p>SUPPLY REPORT</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('purchaseReport') }}" class="nav-link">
                                        <i class="far nav-icon"></i>
                                        <p>PURCHASE REPORT</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="nav-icon fa fa-id-card"></i>
                                <p>
                                    PROFILE
                                </p>
                            </a>
                            <div class="button" aria-labelledby="">
                              {{--   <a class="" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a> --}}

                                {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form> --}}
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper ">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('pagetitle')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="">Home</a></li>
                                <li class="breadcrumb-item active">@yield('pagetitle')</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            @yield('mainbody')

        </div>
        <!-- /.content-wrapper -->
        {{-- <footer class="main-footer">

        </footer> --}}

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    {{-- DataTables --}}
    <script src="DataTables/datatables.min.js"></script>
    <script>
        // Initialize All Tables
        $(document).ready(function() {
            // Initialize DataTable for #mytable
            $('#mytable').DataTable({
              "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                order: [[0, 'desc']],


            });

            $('#reportTable').DataTable({
                "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                order: [[0, 'desc']],
                dom: 'Bfrtip',
                buttons: ['print'],

            })

            // Initialize DataTable for #showEmployee on document ready

        });
    </script>
    <script>
        function updateDate() {
            var currentDate = new Date();
            document.getElementById("current-date").innerText = currentDate.toLocaleString();
        }

        // Update the date immediately when the page loads
        window.onload = function() {
            updateDate();
            // Update the date every second
            setInterval(updateDate, 1000);
        };
    </script>

</body>
</html>
