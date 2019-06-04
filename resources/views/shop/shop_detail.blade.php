@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Detail Toko</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/shop" class="breadcrumb-link">Toko</a></li>
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
        @foreach($shop as $key)
        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 col-12">
            <!-- ============================================================== -->
            <!-- card shop profile -->
            <!-- ============================================================== -->
            <div class="card">
                <div class="card-body">
                    <div>
                        <h2 class="font-24 mb-0">{{ $key->name }}</h2>
                    </div>
                </div>
                <div class="card-body border-top">
                    <h3 class="font-16">Informasi</h3>
                    <div class="">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-fw fa-home mr-2"></i>{{ $key->address }}</li>
                            <li class="mb-0"><i class="fas fa-fw fa-phone mr-2"></i>{{ $key->telephone }}</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <h3 class="font-16">Deskripsi</h3>
                    <p>{{ $key->description }}</p>
                </div>
                <div class="card-body border-top">
                    <h3 class="font-16">Pengaturan</h3>
                    <div class="d-flex">
                        <a href="{{ route('shop.edit', $key->id) }}" class="btn btn-warning mr-2"><i class="fas fa-fw fa-edit mr-2"></i>Edit</a>
                        <form action="{{route('shop.destroy',[$key->id])}}" method="POST">
                            <input type="hidden" name="_method" value="Delete">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash mr-2"></i>Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end card shop profile -->
        <!-- ============================================================== -->
        @endforeach
        <!-- ============================================================== -->
        <!-- table product stock -->
        <!-- ============================================================== -->
        <div class="col-xl-9 col-lg-9 col-md-7 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Persediaan Barang</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Unit</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stocks as $key)
                                <tr>
                                    <td>{{ $key->product_item_code }}</td>
                                    <td>{{ $key->name }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $key->stock }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end table product stock -->
        <!-- ============================================================== -->
    </div>
</div>
@stop

@push('custom-scripts')
<script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
@endpush