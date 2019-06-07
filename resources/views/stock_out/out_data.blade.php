@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Riwayat Stock Out</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Menu</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Riwayat Stock Out</li>
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
                    <a href="{{ route('transaction.stock-out.create') }}" class="btn btn-primary text-light">Tambah Stock Out</a>
                </h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Item</th>
                                    <th>QTY</th>
                                    <th>Detail</th>
                                    <th>Tanggal</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stock_outs as $key)
                                <tr>
                                    <td>{{ $key->code }}</td>
                                    <td>{{ $key->name }}</td>
                                    <td>{{ $key->qty }}</td>
                                    <td>{{ $key->detail }}</td>
                                    <td>{{ $key->date }}</td>
                                    <td class="d-flex">
                                        <form action="{{route('transaction.stock-out.destroy',[$key->id])}}" method="POST">
                                            <input type="hidden" name="_method" value="Delete">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
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
</div>
@stop

@push('custom-scripts')
<script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/selling.js')}}" type="text/javascript"></script>
@endpush