@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Detail Mutasi </h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/transaction/mutation" class="breadcrumb-link">Riwayat Mutasi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header p-4">
                    <h3 class="mb-0">Kode : {{ $mutations->code }}</h3>
                    <br>
                    Tanggal: {{ $mutations->date }} &nbsp;
                </div>
                <div class="card-body">

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="mb-3">Asal : </h5>
                            <h3 class="text-dark mb-1">{{ $mutations->source_name }}</h3>
                            <p>{{ $mutations->source_address }}</p>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="mb-3">Tujuan :</h5>
                            <h3 class="text-dark mb-1">{{ $mutations->destination_name }}</h3>
                            <p>{{ $mutations->destination_address }}</p>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Item</th>
                                    <th class="center">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mutation_details as $key)
                                <tr>
                                    <td>{{ $key->code }}</td>
                                    <td class="left strong">{{ $key->name }}</td>
                                    <td class="center">{{ $key->qty }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white">
                <p class="mb-0">
                    Catatan : <br>

                </p>
            </div>

        </div>
    </div>

</div>
@stop

@push('custom-scripts')
<script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/purchase.js')}}" type="text/javascript"></script>
@endpush