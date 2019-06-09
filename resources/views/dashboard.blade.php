@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Dashboard</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Menu</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
        <!-- Total Income -->
        <!-- ============================================================== -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Total Pendapatan</h5>
                <div class="card-body">
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1 text-success">Rp <span id="income">{{ $income }}</span></h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Total Income -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Total Profit -->
        <!-- ============================================================== -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Keuntungan</h5>
                <div class="card-body">
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1 text-primary">Rp <span id="profit">{{ $profit }}</span></h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Total Profit -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- recent orders  -->
        <!-- ============================================================== -->
        <div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Penjualan Terakhir</h5>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">#</th>
                                    <th class="border-0">Kode</th>
                                    <th class="border-0">Tanggal</th>
                                    <th class="border-0">Jam</th>
                                    <th class="border-0">Keuntungan</th>
                                    <th class="border-0">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSelling as $key)
                                <tr>
                                    <td></td>
                                    <td>{{ $key->code }}</td>
                                    <td>{{ $key->date }}</td>
                                    <td>{{ $key->time }}</td>
                                    <td>{{ $key->profit_total }}</td>
                                    <td>{{ $key->grand_total }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="9"><a href="{{ url('transaction/selling') }}" class="btn btn-outline-light float-right">Detail</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end recent orders  -->
        <!-- ============================================================== -->
    </div>
</div>
@stop
@push('custom-scripts')
<script>
    $(document).ready(function() {
        var income = $('#income').text()
        income = income.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        $('#income').html(income)

        var profit = $('#profit').text()
        profit = profit.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        $('#profit').html(profit)
    })
</script>
@endpush