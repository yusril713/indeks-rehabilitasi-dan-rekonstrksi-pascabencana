@extends('layouts.admin')
@section('title')
    Data Responden
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Responden
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('manage-petugas.index') }}"> Data Petugas</a></li>
            <li class="active">Tambah</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Data Petugas & Responden</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('manage-petugas.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-5 col-md-offset-3">
                        <form action="{{ route('manage-responden.store') }}" class="form-horizontal" method="post">
                            @csrf
                            <input type="hidden" name="keterangan_tempat_id" value="{{ $ket_tempat->id }}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">@role('Super Admin|Level 3')Pilih Petugas @endrole @role('Level 1|Level 2')Petugas @endrole</label>
                                    <div class="col-sm-8">
                                        @role('Super Admin|Level 3')
                                        <select name="petugas" id="" class="form-control select2 @error('petugas') is-invalid @enderror">
                                            <option value="">Pilih Petugas</option>
                                            @foreach ($petugas as $item)
                                            <option value="{{ $item->id }}" {{ $survei ? ($survei->petugas_id == $item->id ? 'selected' : '') : (old('petugas') == $item->id ? 'selected' : '')  }}>{{ $item->nip }} - {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        @endrole
                                        @role('Level 1|Level 2')
                                        <input type="hidden" name="petugas" value="{{ $petugas->id }}">
                                        <div class="input-group">
                                            <input type="text" name="petugas_nama" class="form-control  @error('petugas_nama') is-invalid @enderror" value="{{ $petugas ? $petugas->nama : old('petugas') }}" readonly>
                                            @error('petugas_nama')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        @error('petugas')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        @endrole
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Tanggal Survei</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="tgl_survei" class="form-control datepicker @error('tgl_survei') is-invalid @enderror" value="{{ $survei ? $survei->tgl_survei : old('tgl_survei') }}">
                                            @error('tgl_survei')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Tanggal Diperiksa</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="tgl_periksa" id="" class="form-control datepicker @error('tgl_periksa') is-invalid @enderror" value="{{ $survei ? $survei->tgl_periksa : old('tgl_periksa') }}">
                                            @error('tgl_periksa')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Nama Responden</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="nama_responden" class="form-control @error('nama_responden') is-invalid @enderror" value="{{ $survei ? $survei->nama_responden : old('nama_responden') }}">
                                        @error('nama_responden')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">No. Hp</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="no_hp" id="" class="form-control @error('no_hp') is-invalid @enderror" value="{{ $survei ? $survei->no_hp : old('no_hp') }}">
                                        @error('no_hp')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">No Responden</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="no_responden" id="" class="form-control @error('no_responden') is-invalid @enderror" value="{{ $survei ? $survei->no_responden : old('no_responden') }}">
                                        @error('no_responden')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">No Kartu Keluarga</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="no_kk" id="" class="form-control @error('no_kk') is-invalid @enderror" value="{{ $survei ? $survei->no_kk : old('no_kk') }}">
                                        @error('no_kk')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Lokasi Asal</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="lokasi_asal" id="" class="form-control @error('lokasi_asal') is-invalid @enderror" value="{{ $survei ? $survei->lokasi_asal : old('lokasi_asal') }}">
                                        @error('lokasi_asal')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer pull-right">
                                <a href="" class="btn btn-primary bt_save"><i class="fa fa-backward"></i>&nbsp; Previous</a>
                                <button class="btn btn-success bt_save" type="submit">Next &nbsp;<i class="fa fa-forward"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection
