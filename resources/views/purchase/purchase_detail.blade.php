@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Detail Pembelian </h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/transaction/purchase" class="breadcrumb-link">Riwayat Pembelian</a></li>
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
                    @foreach($purchases as $key)
                    <h3 class="mb-0">Kode : {{ $key->code }}</h3>
                    <br>
                    Tanggal: &nbsp; {{ $key->date }}
                    <br>
                    Jam : &nbsp; {{ $key->time }}
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="mb-3">Supplier :</h5>
                            <h3 class="text-dark mb-1">{{ $key->supplier_name }}</h3>
                            <div>{{ $key->supplier_address }}</div>
                            <div>Tlp: {{ $key->supplier_telephone }}</div>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="mb-3">Toko Penerima :</h5>
                            <h3 class="text-dark mb-1">{{ $key->shop_name }}</h3>
                            <div>{{ $key->shop_address }}</div>
                            <div>Tlp: {{ $key->shop_telephone }}</div>
                        </div>
                    </div>
                    @endforeach

                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Item</th>
                                    <th class="right">Harga</th>
                                    <th class="center">Qty</th>
                                    <th class="right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchase_details as $key)
                                <tr>
                                    <td>{{ $key->product_item_code }}</td>
                                    <td class="left strong">{{ $key->name }}</td>
                                    <td class="right">{{ $key->price }}</td>
                                    <td class="center">{{ $key->qty }}</td>
                                    <td class="right">{{ $key->sub_total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Total</strong>
                                        </td>
                                        @foreach($purchases as $key)
                                        <td class="right">
                                            <strong class="text-dark">Rp {{ $key->grand_total }}</strong>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white">
                    <p class="mb-0">
                        Catatan : <br>
                        {{ $key->note }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop

@push('custom-scripts')
<script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/purchase.js')}}" type="text/javascript"></script>
@endpush