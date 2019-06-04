@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Edit Toko</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('shop') }}" class="breadcrumb-link">Toko</a></li>
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
                    @foreach($shop as $key)
                    <form action="{{ route('shop.update', $key->id) }}" method="POST">
                        {{ csrf_field() }}

                        <input name="_method" type="hidden" value="PUT">

                        <!-- Name -->
                        <div class="form-group">
                            <label for="inputText1" class="col-form-label">Nama Toko *</label>
                            <input value="{{ $key->name }}" id="inputText1" type="text" class="form-control" name="name" required>
                        </div>

                        <!-- Telephone -->
                        <div class="form-group">
                            <label>No Telepon *<small class="text-muted">(999) 999-9999</small></label>
                            <input value="{{ $key->telephone }}" type="text" class="form-control phone-inputmask" id="phone-mask" name="telephone" required>
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <label for="inputText2" class="col-form-label">Alamat *</label>
                            <input value="{{ $key->address }}" id="inputText2" type="text" class="form-control" name="address" required>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Deskripsi </label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{ $key->description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" name="save">Simpan</button>

                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('custom-scripts')
<script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
@endpush