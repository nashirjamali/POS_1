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
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">
                    Informasi
                </h5>

                <div class="card-body">

                    <!-- Date -->
                    <div class="form-group">
                        <label for="inputDate1">Tanggal</label>
                        <input type="date" id="mutation-date" class="form-control">
                    </div>

                    <div class="form-group">
                        <p>Toko Asal</p>
                        <h4>{{ $source->name }}</h4>

                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Toko Tujuan</label>
                        <select name="destination" id="destination_id" class="form-control">
                            @foreach($shops as $key)
                            <option value="{{ $key->id }}">{{ $key->name }}</option>
                            @endforeach
                        </select>
                    </div>
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
                    <form action="{{ route('transaction.mutation.detail.insert') }}" method="POST">
                        {{ csrf_field() }}

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
                        <input type="hidden" value="{{ $source->id }}" name="source_id" id="source_id">
                        <div class="row">
                            <!-- QTY -->
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 form-group">
                                <label>QTY</label>
                                <input type="number" name="qty" id="qty" class="form-control">
                            </div>

                            <!-- Discount -->
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 form-group">
                                <label>Sisa Stock</label>
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
        <!-- ============================================================== -->
        <!-- Mutation Code -->
        <!-- ============================================================== -->
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Kode Mutasi</h5>
                <div class="card-body">
                    <h1>{{ $mutation_code }}</h1>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Mutation Code -->
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
                                @foreach($temps as $key)
                                <tr>
                                    <td>{{ $key->code }}</td>
                                    <td>{{ $key->name }}</td>
                                    <td>{{ $key->qty }}</td>
                                    <td class="d-flex">
                                        <button class="btn btn-warning mr-2" data-toggle="modal" data-target="#editModal"><i class="fas fa-fw fa-edit"></i></button>

                                        <form action="{{ route('transaction.mutation.detail.delete',$key->id) }}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="source_id" value="{{ $source->id }}">
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i></button>
                                        </form>
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
                                                <form action="{{ route('transaction.mutation.detail.update', $key->id ) }}" method="POST">

                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="id" id="" value="{{ $key->id }}">
                                                    <input type="hidden" value="{{ $source->id }}" name="source_id" id="">

                                                    <!-- Product Item Code -->
                                                    <div class="form-group">
                                                        <label for="">Kode Barang</label>
                                                        <input type="text" name="item_code" disabled class="form-control" value="{{ $key->code }}">
                                                    </div>

                                                    <!-- Product Item Name -->
                                                    <div class="form-group">
                                                        <label for="">Nama Barang</label>
                                                        <input type="text" disabled class="form-control" value="{{ $key->name }}">
                                                    </div>

                                                    <!-- QTY -->
                                                    <div class="form-group">
                                                        <label for="">QTY</label>
                                                        <input type="number" name="qty" class="form-control" value="{{ $key->qty }}">
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
    </div>
    <!-- ============================================================== -->
    <!-- End Product Table -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Button Submit -->
    <!-- ============================================================== -->
    <button class="btn btn-primary btn-lg" id="btn-submit">Submit</button>
    <!-- ============================================================== -->
    <!-- End Button Submit -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- Item Modal -->
<!-- ============================================================== -->
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-100 w-50" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table style="width: 100%" id="item-table" class="table display table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Sisa Stock</th>
                                <th>Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stocks as $key)
                            <tr>
                                <td>{{ $key->code }}</td>
                                <td>{{ $key->name }}</td>
                                <td>{{ $key->stock }}</td>
                                <td>
                                    <button type="submit" data-dismiss="modal" class="btn-select-item btn btn-sm text-dark btn-info"><i class="fas fa-fw fa-plus"></i></button>
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
<!-- End Item Modal -->
<!-- ============================================================== -->

@stop
@push('custom-scripts')
<script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        var today = new Date().toISOString().substr(0, 10)
        $('#mutation-date').val(today)

        $('.btn-select-item').click(function() {
            var row = $(this).closest("tr"),
                code = row.find("td:nth-child(1)"),
                stock = row.find("td:nth-child(3)")

            $.each(code, function() {
                $('#item_code').val($(this).text())
            })
            $.each(stock, function() {
                $('#stock').val($(this).text())
                $('#qty').attr('max', $(this).text())
                $('#qty').attr('min', 1)
            })
        })


        $('#btn-submit').click(function() {
            var destinationId = $('#destination_id').val()
            var sourceId = $('#source_id').val()
            var mutationDate = $('#mutation-date').val()
            var _token = $('input[name="_token"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ url("transaction/mutation/insert") }}',
                method: "POST",
                data: {
                    mutationDate: mutationDate,
                    destinationId: destinationId,
                    sourceId: sourceId,
                    _token: _token
                },
                success: data => {
                    if (data == 1) {
                        window.location.href = "/transaction/mutation";
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    alert(ajaxOptions)
                }
            })


        })
    })
</script>
@endpush