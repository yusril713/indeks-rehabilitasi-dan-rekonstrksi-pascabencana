
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') &raquo; Indeks Rehabilitasi & Rekonstruksi Pascabencana - BNPB</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Icon -->
    <link rel="icon" type="image/png" href="{{ asset('styles/images/logo/logo.png') }}"/>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('styles/plugins/iCheck/all.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{ asset('styles/plugins/timepicker/bootstrap-timepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('styles/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('styles/css/skins/_all-skins.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('styles/plugins/iCheck/flat/blue.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('styles/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap" rel="stylesheet">
    <!-- Preload -->
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/css/preload.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/sweetalert2/bootstrap-4.min.css') }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Images --}}
    <link rel="stylesheet" href="{{ asset('vendor/images/image-uploader.min.css') }}">

    <link rel="stylesheet" href="{{ asset('styles/vendor/fancybox/jquery.fancybox.css') }}">
    @yield('style')

    @livewireStyles
</head>

<body class="hold-transition skin-yellow fixed sidebar-mini">

    @include('layouts.preload')

    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="logo">
                <span class="logo-mini"><img src="{{ asset('styles/images/logo/logo1.png') }}" alt="Ina-PDRI" width="30" height="auto"></span>
                <span class="logo-lg"><img src="{{ asset('styles/images/logo/logo3.png') }}" alt="Ina-PDRI" width="120" height="auto"></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        {{-- <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="{{ asset('styles/images/user/user3-128x128.jpg') }}" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="{{ asset('styles/images/user/user4-128x128.jpg') }}" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="{{ asset('styles/images/user/user3-128x128.jpg') }}" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="{{ asset('styles/images/user/user4-128x128.jpg') }}" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>

                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-red"></i> 5 new members joined
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user text-red"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>

                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li> --}}

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ Auth::user()->profile_photo_url }}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <div class="box-widget widget-user">
                                    <div class="widget-user-header text-white" style="background: url('{{ asset('styles/images/photo4.jpg') }}') center center;"></div>
                                    <div class="widget-user-image">
                                        <img class="img-circle" src="{{ Auth::user()->profile_photo_url }}" alt="User Avatar">
                                    </div>
                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-xs-12 text-left">
                                                <strong>PENGGUNA</strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 text-left">
                                                <p>admin@admin.com</p>
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <a href="{{ route('ganti-password') }}" class="btn bg-yellow btn-sm"><i class="fa fa-cog"></i></a>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 text-left">
                                                <strong>NAMA</strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 text-left">
                                                <p>{{ Auth::user()->name }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 text-left">
                                                <strong>LEVEL</strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 text-left">
                                                <p>admin</p>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="pull-center">
                                            <a class="btn bg-red btn-block" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                <i class="mdi mdi-logout mr-2 text-primary"></i> Signout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{ Auth::user()->name }}</p>
                        <a href="#"><i class="fa fa-circle text-green"></i> Online</a>
                    </div>
                </div>
                <!-- <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form> -->
                @role('Super Admin|Level 1|Level 2|Level 3')
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="{{ Request::is('dashboard') ? 'active' : ''}}">
                        <a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                    </li>

                    <li class="header" style="color: #ffffff">MAIN NAVIGATION</li>
                    <li class="{{ (Request::is('manage-petugas') or Request::is('manage-petugas*create') or Request::is('manage-petugas*edit') or Request::is('ganti*password')) ? 'active' : '' }}">
                        <a href="{{ route('manage-petugas.index') }}"><i class="fa fa-user"></i> <span>Data Petugas</span></a>
                    </li>
                    @role('Super Admin|Level 3|Level 2|Level 1')
                    <li class="treeview {{ (Request::is('manage-bencana') or Request::is('manage-bencana*create') or Request::is('manage-bencana*edit') or Request::is('manage-bencana*') or Request::is('manage-foto') or Request::is('manage-foto*create')) ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-files-o"></i>
                            <span>Data Bencana</span><span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ (Request::is('manage-bencana') or Request::is('manage-bencana*create') or Request::is('manage-bencana*edit') or Request::is('manage-bencana*')) ? 'active' : '' }}"><a href="{{ route('manage-bencana.index') }}"><i class="fa fa-circle-o"></i> Data Bencana</a></li>
                            <li class="{{ (Request::is('manage-foto') or Request::is('manage-foto*create')) ? 'active' : '' }}"><a href="{{ route('manage-foto.index') }}"><i class="fa fa-circle-o"></i> Foto Bencana</a></li>
                        </ul>
                    </li>
                    @endrole

                    <li class="header" style="color: #ffffff">INDEX</li>
                    <li class="treeview {{ (Request::is('keterangan-tempat') or Request::is('sektor-pemukiman/*') or Request::is('sektor-infrastruktur/*') or Request::is('sektor-sosial/*') or Request::is('sektor-ekonomi/*') or Request::is('lintas-sektor/*') or Request::is('keterangan-tempat.create')) ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-files-o"></i>
                            <span>Kuesioner</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu" style="{{ (Request::is('manage-responden/*') or Request::is('sektor-pemukiman/*') or Request::is('sektor-infrastruktur/*') or Request::is('sektor-sosial/*') or Request::is('sektor-ekonomi/*') or Request::is('lintas-sektor/*')) ? 'display:block' : '' }}">
                            <li class="{{ (Request::is('keterangan-tempat')) ? 'active' : '' }}"><a href="{{ route('keterangan-tempat.index') }}"><i class="fa fa-circle-o"></i> Keterangan Tempat</a></li>
                            <li class="{{ (Request::is('sektor-pemukiman/*')) ? 'active' : '' }}" ><a href="{{ route('sektor-pemukiman.readonly') }}"><i class="fa fa-circle-o"></i> Sektor Pemukiman</a></li>
                            <li class="{{ (Request::is('sektor-infrastruktur/*')) ? 'active' : '' }}"><a href="{{ route('sektor-infrastruktur.readonly') }}"><i class="fa fa-circle-o"></i> Sektor Infrastruktur</a></li>
                            <li class="{{ (Request::is('sektor-sosial/*')) ? 'active' : '' }}"><a href="{{ route('sektor-sosial.readonly') }}"><i class="fa fa-circle-o"></i> Sektor Sosial</a></li>
                            <li class="{{ (Request::is('sektor-ekonomi/*')) ? 'active' : '' }}"><a href="{{ route('sektor-ekonomi.readonly') }}"><i class="fa fa-circle-o"></i> Sektor Ekonomi</a></li>
                            <li class="{{ (Request::is('lintas-sektor/*')) ? 'active' : '' }}"><a href="{{ route('lintas-sektor.readonly') }}"><i class="fa fa-circle-o"></i> Lintas Sektor</a></li>
                        </ul>
                    </li>
                    <li class="header" style="color: #ffffff">PROCESS</li>
                    <li class="{{ Request::is('manage-process') ? 'active' : '' }}">
                        <a href="{{ route('manage-process.index') }}"><i class="fa fa-files-o"></i><span>Hitung Indeks RR</span></a>
                    </li>
                    <li class="header" style="color: #ffffff">REPORT</li>
                    <li class="{{ Request::is('database*responden') ? 'active' : '' }}">
                        <a href="{{ route('database.responden') }}"><i class="fa fa-hourglass-end"></i> <span>Responden</span></a>
                    </li>
                    @role('Super Admin|Level 3|Level 2')
                    <li class="{{ Request::is('database*kelurahan') ? 'active' : '' }}">
                        <a href="{{ route('database.kelurahan') }}"><i class="fa fa-external-link"></i> <span>Kelurahan/Desa</span></a>
                    </li>
                    <li class="{{ Request::is('database*kecamatan') ? 'active' : '' }}">
                        <a href="{{ route('database.kecamatan') }}"><i class="fa fa-exchange"></i> <span>Kecamatan</span></a>
                    </li>
                    <li class="{{ Request::is('database*kabupaten') ? 'active' : '' }}">
                        <a href="{{ route('database.kabupaten') }}"><i class="fa fa-cube"></i> <span>Kabupaten</span></a>
                    </li>
                    <li class="{{ Request::is('database*provinsi') ? 'active' : '' }}">
                        <a href="{{ route('database.provinsi') }}"><i class="fa fa-database"></i> <span>Provinsi</span></a>
                    </li>
                    <li class="header" style="color: #ffffff">INFO</li>
                    <li class="{{ Request::is('gallery') ? 'active' : '' }}">
                        <a href="{{ route('manage-gallery') }}"><i class="fa fa-photo"></i> <span>Galeri</span></a>
                    </li>
                    <li class="{{ Request::is('referensi') ? 'active' : '' }}">
                        <a href="{{ route('referensi.index') }}"><i class="fa fa-share-alt"></i> <span>Referensi</span></a>
                    </li>
                    @endrole
                    @role('Super Admin')
                    <li class="header" style="color: #ffffff">Role & Permission</li>
                    <li class="{{ (Request::is('manage-role') or Request::is('manage-role*create') or Request::is('manage-role*edit')) ? 'active' : '' }}">
                        <a href="{{ route('manage-role.index') }}"><i class="fa fa-exchange"></i> <span>Role</span></a>
                    </li>
                    <li class="{{ Request::is('manage-permission') ? 'active' : '' }}">
                        <a href="{{ route('manage-permission.index') }}"><i class="fa fa-eyedropper"></i> <span>Permission</span></a>
                    </li>
                    <li class="{{ Request::is('assign-role') ? 'active' : '' }}">
                        <a href="{{ route('assign-role.index') }}"><i class="fa fa-filter"></i> <span>Assign Role</span></a>
                    </li>
                    <li class="{{ Request::is('assign-permission') ? 'active' : '' }}">
                        <a href="{{ route('assign-permission.index') }}"><i class="fa fa-gears"></i> <span>Assign Permission</span></a>
                    </li>
                    @endrole
                </ul>
                @endrole
            </section>
        </aside>

        @yield('content')

        <footer class="main-footer">
            {{-- <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div> --}}
            Copyright &copy; 2021 <strong><a href="https://inapdri.bnpb.co.id" class="text-yellow">Indeks Rehabilitasi & Rekonstruksi Pascabencana - BNPB</a></strong>. All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane" id="control-sidebar-home-tab">
                    <h3 class="control-sidebar-heading">Recent Activity</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                    <p>Will be 23 on April 24th</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-user bg-yellow"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                    <p>New phone +1(800)555-1234</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                    <p>nora@example.com</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                    <p>Execution time 5 seconds</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->

                    <h3 class="control-sidebar-heading">Tasks Progress</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Custom Template Design
                                    <span class="label label-danger pull-right">70%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Update Resume
                                    <span class="label label-success pull-right">95%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Laravel Integration
                                    <span class="label label-warning pull-right">50%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Back End Framework
                                    <span class="label label-primary pull-right">68%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->

                </div>
                <!-- /.tab-pane -->
                <!-- Stats tab content -->
                <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                <!-- /.tab-pane -->
                <!-- Settings tab content -->
                <div class="tab-pane" id="control-sidebar-settings-tab">
                    <form method="post">
                        <h3 class="control-sidebar-heading">General Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Report panel usage
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Some information about this general settings option
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Allow mail redirect
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Other sets of options are available
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Expose author name in posts
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Allow the user to show his name in blog posts
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <h3 class="control-sidebar-heading">Chat Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Show me as online
                                <input type="checkbox" class="pull-right" checked>
                            </label>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Turn off notifications
                                <input type="checkbox" class="pull-right">
                            </label>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Delete chat history
                                <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                            </label>
                        </div>
                        <!-- /.form-group -->
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
        </aside>

        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery 3 -->
    <script src="{{ asset('styles/vendor/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('styles/vendor/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('styles/vendor/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('styles/vendor/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('styles/vendor/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- Morris.js charts -->
    <script src="{{ asset('styles/vendor/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('styles/vendor/bower_components/morris.js/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('styles/vendor/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('styles/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('styles/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('styles/vendor/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('styles/vendor/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('styles/vendor/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('styles/vendor/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('styles/vendor/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('styles/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('styles/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('styles/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('styles/vendor/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('styles/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('styles/vendor/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('styles/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('styles/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('styles/vendor/bower_components/chart.js/Chart.js') }}"></script>
    <script src="{{ asset('styles/vendor/bower_components/chart.js/Chart.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('styles/vendor/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('styles/js/adminlte.min.js') }}"></script>
    {{-- Preloader --}}
    <script src="{{ asset('styles/vendor/preloader.js') }}"></script>
    {{-- Sweetalert2 --}}
    <script src="{{ asset('styles/vendor/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('styles/vendor/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('vendor/images/image-uploader.min.js') }}"></script>

    <script src="{{ asset('styles/vendor/fancybox/jquery.fancybox.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tb').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                'responsive'  : true
            })

            $('.datepicker').datepicker({
                singleDatePicker: true,
                showDropdowns: true,
                format: 'yyyy-mm-dd'
            })

            $('.timepicker').timepicker({
                showInputs: false
            })

            $('.select2').select2()
        });
    </script>

    @yield('script')
    @livewireScripts
</body>

</html>

