@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tambah Karyawan</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('employee') }}" class="breadcrumb-link">Daftar Karyawan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
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
                    <form action="{{ route('employee.store') }}" method="POST">
                        {{ csrf_field() }}

                        <!-- Name -->
                        <div class="form-group">
                            <label for="inputText1">Nama *</label>
                            <input id="name" type="text" class="form-control" name="name" required>
                            <input type="text" name="id" value="{{$id}}" hidden>
                        </div>

                         <!-- jabatan -->
                         <div class="form-group">
                            <label>jabatan *</label>
                            <input type="text" name="jabatan" class="form-control" required>
                        </div>

                        <!-- Level -->
                        <div class="form-group">
                            <label>Level *</label>
                            <select name="level" id="level" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                        <!-- Username -->
                        <div class="form-group">
                            <label>Username *</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <label>Alamat *</label>
                            <textarea rows="2" name="address" class="form-control" required></textarea>
                        </div>

                        <!-- Telephone -->
                        <div class="form-group">
                            <label for="">Telepon *</label>
                            <input type="text" name="telephone" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary" name="save">Simpan</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('custom-scripts')
<script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
@endpush