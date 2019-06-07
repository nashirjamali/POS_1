@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tambah Stock Out</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('transaction/stock-out') }}" class="breadcrumb-link">Riwayat Stock Out</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Stock Out</li>
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
        <div class="offset-xl-3 col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Form</h5>
                <div class="card-body">
                    <form action="{{ route('transaction.stock-out.store') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="row">
                            <!-- Date -->
                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date">
                            </div>

                            <!-- Shop -->
                            <div class="form-group col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="">Toko</label>
                                <select name="shop" id="shop" class="select2 form-control">
                                    @foreach($shops as $key)
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Product Item -->
                            <div class="form-group col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label class="col-form-label">Cari Barang</label>
                                <div class="input-group">
                                    <input id="item_code" name="item_code" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" id="btn-search" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalScrollable"><i class="fas fa-fw fa-search"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- Stock -->
                            <div class="form-group col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label class="col-form-label">Stok</label>
                                <input type="text" disabled id="stock" class="form-control">
                            </div>

                            <!-- Detail -->
                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label class="col-form-label">Detail</label>
                                <input type="text" id="detail" class="form-control" name="detail" placeholder="Contoh : Rusak, Hilang, dsb">
                            </div>

                            <!-- QTY -->
                            <div class="form-group col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12"">
                                <label for="">Qty</label>
                                <input type="number" id="qty" class="form-control" name="qty">
                            </div>
                        </div>

                        <button type="submit" id="btn-submit" class="btn btn-primary mt-4" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- Product Modal -->
<!-- ============================================================== -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl mw-100 w-75" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table style="width: 100%" id="table" class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key)
                            <tr>
                                <td>{{ $key->code }}</td>
                                <td>{{ $key->name }}</td>
                                <td>
                                    <button type="submit" data-dismiss="modal" class="btn-select btn btn-sm text-dark btn-info"><i class="fas fa-fw fa-plus"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Product Modal -->
<!-- ============================================================== -->

@stop

@push('custom-scripts')
<script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/stock-out.js')}}" type="text/javascript"></script>
@endpush