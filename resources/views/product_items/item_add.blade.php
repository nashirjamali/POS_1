@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tambah Item Barang</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('product/item') }}" class="breadcrumb-link">Item</a></li>
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
                    <form action="{{ route('product.item.store') }}" method="POST">
                        {{ csrf_field() }}

                        <!-- Code -->
                        <div class="form-group">
                            <label for="inputText1" class="col-form-label">Kode *</label>
                            <input id="inputText1" onblur="checkCode(this)" type="text" class="form-control" name="code" required>
                            <div class="valid-feedback">
                                Kode belum digunakan
                            </div>
                            <div class="invalid-feedback">
                                Kode sudah digunakan
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="form-group">
                            <label for="inputText1" class="col-form-label">Nama Item *</label>
                            <input id="inputText1" type="text" class="form-control" name="name" required>
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="select1" class="col-form-label">Kategori *</label>
                            <select id="select1" class="form-control" name="category_id" required>
                                @foreach($categories as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Unit -->
                        <div class="form-group">
                            <label for="select2" class="col-form-label">Unit *</label>
                            <select id="select2" class="form-control" name="unit_id" required>
                                @foreach($units as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Purchase Price -->
                        <div class="form-group">
                            <label for="inputText3" class="col-form-label">Harga Beli *</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                                <input id="inputText3" type="number" class="form-control" name="purchase_price" required>
                            </div>
                        </div>

                        <!-- Selling Price -->
                        <div class="form-group">
                            <label for="inputText4" class="col-form-label">Harga Jual *</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                                <input id="inputText4" type="number" class="form-control" name="selling_price" required>
                            </div>
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