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
                    <form action="{{ route('transaction.mutation.create2') }}" method="POST">
                        {{ csrf_field() }}
                        <!-- Date -->
                        <div class="form-group w-50">
                            <label for="inputDate1">Tanggal</label>
                            <input type="date" id="mutation-date" name="date" class="form-control">
                        </div>

                        <div class="row">
                            <!-- Source -->
                            <div class="form-group col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <label for="">Asal</label>
                                <div class="input-group mb-3">
                                    <input id="source" name="source_id" type="hidden" class="form-control">
                                    <input id="source-name" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#sourceModal"><i class="fas fa-fw fa-search"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- Destination -->
                            <div class="form-group col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <label for="">Tujuan</label>
                                <div class="input-group mb-3">
                                    <input id="destination" name="destination_id" type="hidden" class="form-control">
                                    <input id="destination-name" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#destinationModal"><i class="fas fa-fw fa-search"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Information -->
        <!-- ============================================================== -->
    </div>
</div>

<!-- ============================================================== -->
<!-- Source Modal -->
<!-- ============================================================== -->
<div class="modal fade" id="sourceModal" tabindex="-1" role="dialog" aria-labelledby="sourceModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-100 w-50" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Asal Toko</h5>
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
                                <th>Alamat</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shops as $key)
                            <tr>
                                <td>{{ $key->id }}</td>
                                <td>{{ $key->name }}</td>
                                <td>{{ $key->address }}</td>
                                <td>
                                    <button type="submit" data-dismiss="modal" class="btn-select-source btn btn-sm text-dark btn-info"><i class="fas fa-fw fa-plus"></i></button>
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
<!-- End Source Modal -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Destination Modal -->
<!-- ============================================================== -->
<div class="modal fade" id="destinationModal" tabindex="-1" role="dialog" aria-labelledby="destinationModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-100 w-50" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Tujuan Toko</h5>
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
                                <th>Alamat</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shops as $key)
                            <tr>
                                <td>{{ $key->id }}</td>
                                <td>{{ $key->name }}</td>
                                <td>{{ $key->address }}</td>
                                <td>
                                    <button type="submit" data-dismiss="modal" class="btn-select-destination btn btn-sm text-dark btn-info"><i class="fas fa-fw fa-plus"></i></button>
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
<!-- End Destination Modal -->
<!-- ============================================================== -->
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
                    <table style="width: 100%" id="item-table" class="display table-striped table-bordered first">

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

        $('.btn-select-source').click(function() {
            var row = $(this).closest("tr"),
                id = row.find("td:nth-child(1)"),
                name = row.find("td:nth-child(2)")

            $.each(id, function() {
                $('#source').val($(this).text())
            })
            $.each(name, function() {
                $('#source-name').val($(this).text())
            })
        })

        $('.btn-select-destination').click(function() {
            var row = $(this).closest("tr"),
                id = row.find("td:nth-child(1)"),
                name = row.find("td:nth-child(2)")

            $.each(id, function() {
                $('#destination').val($(this).text())
            });
            $.each(name, function() {
                $('#destination-name').val($(this).text())
            });
        })

    })
</script>
@endpush