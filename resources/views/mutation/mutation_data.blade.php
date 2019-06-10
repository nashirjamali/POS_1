@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Riwayat Mutasi</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Menu</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Riwayat Mutasi</li>
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
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">
                    <button class="btn btn-primary text-light" data-target="#shopModal" data-toggle="modal">Tambah Mutasi</button>
                </h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Asal</th>
                                    <th>Tujuan</th>
                                    <th>Jumlah Item</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="d-flex">
                                        <a href="" class="btn btn-warning mr-2">Detail</a>
                                        <form action="}" method="POST">
                                            <input type="hidden" name="_method" value="Delete">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Source Shop Modal -->
<!-- ============================================================== -->
<div class="modal fade" id="shopModal" tabindex="-1" role="dialog" aria-labelledby="shopModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl mw-100 w-50" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Kota Asal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shops as $key)
                            <tr>
                                <td>{{ $key->name }}</td>
                                <td>{{ $key->address }}</td>
                                <td>
                                    <a href="{{ route('transaction.mutation.createalt', $key->id ) }}" class="btn btn-info mr-2">Pilih</a>
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
<!-- End Source Shop Modal -->
<!-- ============================================================== -->
@stop

@push('custom-scripts')
<script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
@endpush