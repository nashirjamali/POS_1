@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Penjualan</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="transaction/selling" class="breadcrumb-link">Riwayat Penjualan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
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
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">
                    Informasi
                </h5>
                <div class="card-body">
                    <form action="">

                        <!-- Date -->
                        <div class="form-group">
                            <label for="inputDate1">Tanggal</label>
                            <input type="date" id="selling-date" class="form-control">
                        </div>

                        <!-- Time -->
                        <div class="form-group">
                            <label for="inputDate1">Jam</label>
                            <input type="time" id="selling-time" class="form-control">
                        </div>

                        <!-- Customer -->
                        <div class="form-group">
                            <label>Customer</label>
                            <select name="customer" id="customer" class="form-control select2">
                                @foreach($customers as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <a href="" data-target="#addCustomerModal" data-toggle="modal" class="btn btn-secondary btn-sm">Tambah Baru</a>
                        </div>

                        <!-- Cashier -->
                        <div class="form-group">
                            <label>Kasir</label>
                            <input name="cashier" value="{{ Auth::user()->name }}" id="cashier" type="hidden" class="form-control">
                            <input value="{{ Auth::user()->name }}" type="text" disabled class="form-control">
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
                    <form action="{{ route('transaction.selling.detail.create') }}" method="POST">
                        {{ csrf_field() }}

                        <input type="hidden" name="selling_code" value="{{ $code }}">
                        <!-- Search Product -->
                        <div class="form-group">
                            <label class="col-form-label">Cari Barang</label>
                            <div class="input-group mb-3">
                                <input id="item_code" name="item_code" type="text" class="form-control">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalScrollable"><i class="fas fa-fw fa-search"></i></button>
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
                                <label>Diskon</label>
                                <input type="number" name="discount" id="discount-item" class="form-control">
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
        <!-- ============================================================== -->
        <!-- Invoice -->
        <!-- ============================================================== -->
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">
                    Invoice
                </h5>
                <div class="card-body">
                    <h3 id="selling-code">{{ $code }}</h3>
                    <h1>Rp <span class="grand-total">0000000</span></h1>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Invoice -->
        <!-- ============================================================== -->

    </div>

    <div class="row">
        <!-- ============================================================== -->
        <!-- Product Table -->
        <!-- ============================================================== -->
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
                                    <th>Harga</th>
                                    <th>Sub Total</th>
                                    <th>Diskon</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selling_details as $key)
                                <tr>
                                    <td>{{ $key->product_item_code }}</td>
                                    <td>{{ $key->name }}</td>
                                    <td>{{ $key->qty }}</td>
                                    <td>{{ $key->selling_price }}</td>
                                    <td>{{ $key->sub_total }}</td>
                                    <td>{{ $key->discount }}</td>
                                    <td class="sub-total">{{ $key->total }}</td>
                                    <td class="d-flex">
                                        <button class="btn btn-warning mr-2" data-toggle="modal" data-target="#editModal"><i class="fas fa-fw fa-edit"></i></button>
                                        <a href="{{ route('transaction.selling.detail.delete', $key->id) }}" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i></a>
                                    </td>
                                </tr>

                                <!-- ============================================================== -->
                                <!-- Edit Modal -->
                                <!-- ============================================================== -->
                                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTittle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('transaction.selling.detail.update', $key->id) }}" method="POST">

                                                    {{ csrf_field() }}

                                                    <!-- Product Item Code -->
                                                    <div class="form-group">
                                                        <label for="">Kode Barang</label>
                                                        <input type="text" name="item_code" disabled class="form-control" value="{{ $key->product_item_code }}">
                                                    </div>

                                                    <!-- Product Item Name -->
                                                    <div class="form-group">
                                                        <label for="">Nama Barang</label>
                                                        <input type="text" disabled class="form-control" value="{{ $key->name }}">
                                                    </div>

                                                    <!-- Selling Price -->
                                                    <div class="form-group">
                                                        <label for="">Harga</label>
                                                        <input type="text" readonly="readonly" disabled class="form-control" value="{{ $key->selling_price }}">
                                                        <input type="hidden" name="selling_price" class="form-control" value="{{ $key->selling_price }}">
                                                        <input type="hidden" name="purchase_price" class="form-control" value="{{ $key->purchase_price }}">
                                                    </div>

                                                    <!-- QTY -->
                                                    <div class="form-group">
                                                        <label for="">QTY</label>
                                                        <input type="number" name="qty" class="form-control" value="{{ $key->qty }}">
                                                    </div>

                                                    <!-- Discount -->
                                                    <div class="form-group">
                                                        <label for="">Diskon</label>
                                                        <input type="number" name="discount" class="form-control" value="{{ $key->discount }}">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ============================================================== -->
                                <!-- End Edit Modal -->
                                <!-- ============================================================== -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Product Table -->
        <!-- ============================================================== -->
    </div>
    <div class="row">
        <!-- ============================================================== -->
        <!-- Total -->
        <!-- ============================================================== -->
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">
                    Total
                </h5>
                <div class="card-body">
                    <form action="" class="container">

                        <div class="form-group">
                            <label for="">Sub Total</label>
                            <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text">Rp</span></span>
                                <input id="total" type="text" disabled class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Diskon</label>
                            <input id="discount" type="number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Grand Total</label>
                            <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text">Rp</span></span>
                                <input type="text" disabled class="form-control grand-total">
                                <input type="hidden" name="" id="grand-total-hidden">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Total -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Payment -->
        <!-- ============================================================== -->
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">
                    Pembayaran
                </h5>
                <div class="card-body">
                    <form action="" class="container">

                        <div class="form-group">
                            <label for="">Cash</label>
                            <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text">Rp</span></span>
                                <input type="text" id="cash" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Change</label>
                            <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text">Rp</span></span>
                                <input type="text" id="change" disabled class="form-control">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Payment -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Note -->
        <!-- ============================================================== -->
        <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">
                    Catatan
                </h5>
                <div class="card-body">
                    <form action="">
                        <div class="form-group">
                            <label for="note">Catatan </label>
                            <textarea class="form-control" id="note" rows="3" name="description"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- End Note -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Button Submit -->
        <!-- ============================================================== -->
        <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
            <button id="btn-submit" class="btn btn-lg btn-primary btn-block">Submit</button>
        </div>
        <!-- ============================================================== -->
        <!-- End Button Submit -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- Add Customer Modal -->
    <!-- ============================================================== -->
    <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customer.store') }}" method="POST">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Telepon</label>
                            <input type="text" class="form-control phone-inputmask" name="telephone">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea type="text" class="form-control" name="address"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Add Customer Modal -->
    <!-- ============================================================== -->
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
                                <th>Harga</th>
                                <th>Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key)
                            <tr>
                                <td>{{ $key->code }}</td>
                                <td>{{ $key->name }}</td>
                                <td>{{ $key->selling_price }}</td>
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
<script src="{{ asset('js/selling.js')}}" type="text/javascript"></script>
@endpush