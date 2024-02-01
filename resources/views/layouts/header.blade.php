<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ url('assets/logo.png') }}">

    <link rel="stylesheet" href="{{ url('fontawesome/css/all.min.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
    <link rel="stylesheet" href="{{ url('css/components.css') }}">

    <link rel="stylesheet" href="{{ url('fontawesome/css/all.min.css') }}">

    <script src="{{ url('bootstrap-4/js/popper.min.js') }}"></script>
    <script src="{{ url('bootstrap-4/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('bootstrap-4/css/bootstrap.min.css') }}"></script>
    <script src="{{ url('bootstrap-4/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ url('bootstrap-4/js/moment.min.js') }}"></script>
    <script src="{{ url('js/stisla.js') }}"></script>

    <script src="{{ url('js/scripts.js') }}"></script>
    <script src="{{ url('js/custom.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <style>
        /* Navbar */
        .form-inline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
        }
    </style>

</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar" style="width: 80%">
                <form class="form-inline" style="margin-right: auto">

                    <ul class="navbar-nav mr-5">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>

                    <h4 class="text-white mt-2"><strong class="text-uppercase">sistem informasi pencatatan aset Koperasi
                            Nusantara VI</strong></h4>


                </form>
                <ul class="navbar-nav">
                    <li class="dropdown"><a href="" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ url('assets/img/avatar/avatar-1.png') }}"
                                class="rounded-circle ">
                            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right w-25">
                            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('dashboard') }}" class="text-uppercase"><img
                                src="{{ url('assets/img/logo.jpeg') }}" alt="LP" width="30px">
                            KKKP Nusantara VI</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ route('dashboard') }}"><img src="{{ url('assets/img/logo.jpeg') }}" alt="LP"
                                width="47px"></a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li <?php if ($title == 'Dashboard') {
                            echo 'class="active"';
                        } ?>><a class="nav-link" href="{{ route('dashboard') }}"><i
                                    class="fas fa-fire"></i>
                                <span>Dashboard</span></a></li>

                        <li class="menu-header">Menu Manajemen</li>
                        @role('ketua')
                            <li <?php if ($title == 'Data Users' || $title == 'Tambah Data Users' || $title == 'Edit Data Users') {
                                echo 'class="active"';
                            } ?>><a class="nav-link" href="{{ route('users') }}"><i
                                        class="fas fa-user"></i>
                                    <span>Data Users</span></a></li>
                        @endrole
                        @role(['anggota', 'ketua'])
                            <li <?php if ($title == 'Kategori Aset' || $title == 'Tambah Kategori Aset' || $title == 'Edit Kategori Aset') {
                                echo 'class="active"';
                            } ?>><a class="nav-link" href="{{ route('kategori') }}"><i
                                        class="fas fa-address-book"></i>
                                    <span>Kategori Aset</span></a></li>
                        @endrole
                        @role(['ketua', 'bendahara', 'anggota'])
                            <li <?php if ($title == 'Data Aset' || $title == 'Tambah Data Aset' || $title == 'Edit Data Aset' || $title == 'Details Aset') {
                                echo 'class="active"';
                            } ?>><a class="nav-link" href="{{ route('aset') }}"><i
                                        class="fas fa-box"></i>
                                    <span>Data Aset</span></a></li>
                            <li <?php if ($title == 'Penyusutan Aset') {
                                echo 'class="active"';
                            } ?>><a class="nav-link" href="{{ route('penyusutan') }}"><i
                                        class="fas fa-business-time"></i>
                                    <span>Penyusutan Aset</span></a></li>

                            <li <?php if ($title == 'Laporan Aset') {
                                echo 'class="active"';
                            } ?>><a class="nav-link" href="{{ route('laporan') }}"><i
                                        class="fas fa-receipt"></i>
                                    <span>Laporan</span></a></li>
                        @endrole

                        <a class="btn btn-danger btn-round w-75 mt-5 mx-3" href="{{ route('logout') }}">
                            Log Out &nbsp;&nbsp;&nbsp; <i class="fas fa-sign-out-alt"></i></a>
                    </ul>


                </aside>
            </div>
            <!-- Main Content -->
            <div class="main-content">
