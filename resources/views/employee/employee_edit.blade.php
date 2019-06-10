@extends('template')
@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Edit Karyawan</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('employee') }}" class="breadcrumb-link">Karyawan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Karyawan</li>
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
                    @foreach($employee as $key)
                    <form action="{{ route('employee.update', $key->id) }}" method="POST">
                        {{ csrf_field() }}

                        <input name="_method" type="hidden" value="PUT">
                        <!-- Name -->
                        <div class="form-group">
                            <label for="inputText1">Nama *</label>
                            <input id="name" type="text" class="form-control" value="{{ $key->name}}" name="name" required>
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
                            <input type="text" name="username" value="{{ $key->username}}" class="form-control" required>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <label>Alamat *</label>
                            <textarea rows="2" name="address" value="{{ $key->address}}" class="form-control" required></textarea>
                        </div>

                        <!-- Telephone -->
                        <div class="form-group">
                            <label for="">Telepon *</label>
                            <input type="text" name="telephone" value="{{ $key->telephone}}" class="form-control" required>
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