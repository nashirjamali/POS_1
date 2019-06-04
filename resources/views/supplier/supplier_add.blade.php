@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tambah Supplier</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('supplier') }}" class="breadcrumb-link">Supplier</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
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
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Form</h5>
                <div class="card-body">
                    <form action="{{ route('supplier.store') }}" method="POST">
                        {{ csrf_field() }}
                        <!-- Name -->
                        <div class="form-group">
                            <label for="inputText1" class="col-form-label">Nama Lengkap *</label>
                            <input id="inputText1" type="text" class="form-control" name="name" required>
                        </div>

                        <!-- Telephone -->
                        <div class="form-group">
                            <label>No Telepon *<small class="text-muted">(999) 999-9999</small></label>
                            <input type="text" class="form-control phone-inputmask" id="phone-mask" name="telephone" required>
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <label for="inputText2" class="col-form-label">Alamat *</label>
                            <input id="inputText2" type="text" class="form-control" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Deskripsi </label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" name="save">Simpan</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @stop

    @push('custom-scripts')
    <script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
    @endpush