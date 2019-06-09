<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Concept - Bootstrap 4 Admin Dashboard Template</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/inputmask/css/inputmask.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/vendor/datatables/css/select.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">

    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="../index.html">Concept</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('assets/assets/images/avatar-1.jpg') }}" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">John Abraham</h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }} " href="{{ url('/') }}"><i class="fa fa-fw fa-user-circle"></i>Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('supplier*') ? 'active' : '' }} " href="{{ route('supplier.index') }}"><i class="fa fa-fw fa-rocket"></i>Supplier</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('product*') ? 'active' : '' }}" href="{{ route('product.item.index') }}" data-toggle="collapse" aria-expanded="{{ request()->is('product*') ? 'true' : 'false' }}" data-target="#submenu-1" aria-controls="submenu-1"><i class="fas fa-fw fa-chart-pie"></i>Produk</a>
                                <div id="submenu-1" class="collapse submenu {{ request()->is('product*') ? 'show' : '' }}" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('product/item*') ? 'active' : '' }}" href="{{ route('product.item.index') }}">Item</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('product/unit*') ? 'active' : '' }}" href="{{ route('product.unit.index') }}">Unit</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('product/category*') ? 'active' : '' }}" href="{{ route('product.category.index') }}">Kategori</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('shop*') ? 'active' : '' }} " href="{{ route('shop.index') }}"><i class="fa fa-fw fa-rocket"></i>Toko</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ request()->is('transaction*') ? 'active' : '' }}" href="" data-toggle="collapse" aria-expanded="{{ request()->is('transaction*') ? 'true' : 'false' }}" data-target="#submenu-2" aria-controls="submenu-2"><i class="fab fa-fw fa-wpforms"></i>Transaksi</a>
                                <div id="submenu-2" class="collapse submenu {{ request()->is('transaction*') ? 'show' : '' }}" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('transaction/purchase*') ? 'active' : '' }}" href="{{ route('transaction.purchase.index') }}">Pembelian</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('transaction/selling*') ? 'active' : '' }}" href="{{ route('transaction.selling.index') }}">Penjualan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('transaction/stock-out*') ? 'active' : '' }}" href="{{ route('transaction.stock-out.index') }}">Stock Out</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('transaction/mutation*') ? 'active' : '' }}" href="{{ route('transaction.mutation.index') }}">Mutasi</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-divider">
                                Pengaturan
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ request()->is('employee*') ? 'active' : '' }}" href="{{ route('employee.index') }}"><i class="fab fa-fw fa-wpforms"></i>Karyawan</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">

            @yield('content')

            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            Copyright © 2019. All rights reserved. Develop by Nashir.
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="{{ asset('assets/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/assets/libs/js/main-js.js') }}"></script>
    <script src="{{ asset('assets/assets/vendor/inputmask/js/jquery.inputmask.bundle.js') }}"></script>

    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('js/select2.min.js') }}"></script>


    @stack('custom-scripts')

</body>

</html>