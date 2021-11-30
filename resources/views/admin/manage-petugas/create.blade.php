@extends('layouts.admin')
@section('title')
    Tambah Data Petugas
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Petugas
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('manage-petugas.index') }}"> Data Petugas</a></li>
            <li class="active">Tambah</li>
        </ol>
    </section>
    <section class="content">
        @if (session('status'))
            <script>
                Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'success'
                );
            </script>
        @endif
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Data Petugas</h3>
                {{-- <div class="box-tools pull-right">
                    <a href="{{ route('manage-petugas.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
                </div> --}}
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-5 col-md-offset-3">
                        <form action="{{ route('manage-petugas.store') }}" class="form-horizontal" method="post"  onsubmit="return confirm('Yakin ingin menyimpan data tersebut?')">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">No Identitas</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="no_identitas" class="form-control @error('no_identitas') is-invalid @enderror" value="{{ old('no_identitas') }}">
                                        @error('no_identitas')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Nama Lengkap</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
                                        @error('password')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Level Pengguna</label>
                                    <div class="col-sm-8">
                                        <select name="role" class="form-control @error('role') is-invalid @enderror">
                                            <option value="">Pilih Level Pengguna</option>
                                            @foreach ($roles as $item)
                                                <option value="{{ $item->name }}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Jenis Kelamin</label>
                                    <div class="col-sm-8">
                                        <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Pria</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Wanita</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Tempat Lahir</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}">
                                        @error('tempat_lahir')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Tanggal Lahir</label>
                                    <div class="col-sm-8">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="tanggal_lahir" id="" class="form-control datepicker @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}">
                                            @error('tanggal_lahir')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">No Hp</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="no_hp" id="" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}">
                                        @error('tanggal_lahir')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <textarea name="alamat" cols="30" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                                    </div>
                                </div>

                                
                            </div>

                            <div class="col-md-8 col-md-offset-4">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success btn-sm bt_save"><i class="fa fa-save"></i> Simpan</button>
                                </div>

                                <div class="pull-left">
                                    <a href="{{ route('manage-petugas.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
