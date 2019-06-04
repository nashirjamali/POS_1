@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Edit Unit</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('product.category') }}" class="breadcrumb-link">Kategori</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
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
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Form</h5>
                <div class="card-body">
                    @foreach($category as $key)
                    <form action="{{ route('product.category.update', $key->id) }}" method="POST">
                        {{ csrf_field() }}

                        <input name="_method" type="hidden" value="PUT">
                        
                        <!-- Name -->
                        <div class="form-group">
                            <label for="inputText1" class="col-form-label">Nama Unit *</label>
                            <input id="inputText1" value="{{ $key->name }}" type="text" class="form-control" name="name" required>
                        </div>

                        <button type="submit" class="btn btn-primary" name="save">Simpan</button>
                        <button class="btn btn-dark" name="save">Reset</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @stop

    @push('custom-scripts')
    <script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
    @endpush