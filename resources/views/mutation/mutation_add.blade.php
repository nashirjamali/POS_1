@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Mutasi</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('transaction/mutation') }}" class="breadcrumb-link">Riwayat Mutasi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mutasi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- ============================================================== -->
        <!-- Information -->
        <!-- ============================================================== -->
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">
                    Informasi
                </h5>
                <div class="card-body">
                    <form action="">

                        <!-- Date -->
                        <div class="form-group w-50">
                            <label for="inputDate1">Tanggal</label>
                            <input type="date" id="selling-date" class="form-control">
                        </div>

                        <div class="row">
                            <!-- Source -->
                            <div class="form-group col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <label for="">Asal</label>
                                <div class="input-group mb-3">
                                    <input id="source" name="source" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sourceModal"><i class="fas fa-fw fa-search"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- Destination -->
                            <div class="form-group col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <label for="">Tujuan</label>
                                <div class="input-group mb-3">
                                    <input id="source" name="source" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#destinationModal"><i class="fas fa-fw fa-search"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Information -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Add Product -->
        <!-- ============================================================== -->
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">
                    Tambah Barang
                </h5>
                <div class="card-body">
                    <form action="{{ route('transaction.mutation.create') }}" method="POST">
                        {{ csrf_field() }}

                        <input type="hidden" name="selling_code" value="">
                        <!-- Search Product -->
                        <div class="form-group">
                            <label class="col-form-label">Cari Barang</label>
                            <div class="input-group mb-3">
                                <input id="item_code" name="item_code" type="text" class="form-control">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#itemModal"><i class="fas fa-fw fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- QTY -->
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 form-group">
                                <label>QTY</label>
                                <input type="number" name="qty" id="qty" class="form-control">
                            </div>

                            <!-- Discount -->
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 form-group">
                                <label>Stock</label>
                                <input type="number" name="stock" id="stock" disabled class="form-control">
                            </div>

                        </div>

                        <!-- Button Add -->
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Add Product -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- Product Table -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">
                    Daftar Barang
                </h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>QTY</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Product Table -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Button Submit -->
    <!-- ============================================================== -->
    <button class="btn btn-primary btn-lg">Submit</button>
    <!-- ============================================================== -->
    <!-- End Button Submit -->
    <!-- ============================================================== -->

</div>

@stop

@push('custom-scripts')
<script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/selling.js')}}" type="text/javascript"></script>
@endpush