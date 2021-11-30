@extends('layouts.admin')
@section('title')
    Password
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Password
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('manage-petugas.index') }}"> Petugas</a></li>
            <li class="active">Ganti Password</li>
        </ol>
    </section>


    <section class="content">
        @if (session('status'))
            <script>
                Swal.fire(
                    'Messages',
                    'You clicked the button!',
                    'success'
                );
            </script>
        @endif
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Ganti Password</h3>

                {{-- <div class="box-tools pull-right">
                    <a href="{{ route('manage-bencana.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
                </div> --}}
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-5 col-md-offset-3">
                        <form id="ff" action="{{ route('manage-petugas.pass_post') }}" class="form-horizontal" method="post" enctype="multipart/form-data"  onsubmit="return confirm('Yakin ingin menyimpan data tersebut?')">
                            @csrf
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="nama" class="col-sm-4 control-label">Password Lama</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="current_password" value="{{ old('current_password') }}">
                                        @error('current_password')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nama" class="col-sm-4 control-label">Password Baru</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" value="{{ old('new_password') }}">
                                        @error('new_password')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nama" class="col-sm-4 control-label">Konfirmasi Password Baru</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" id="new_confirm_password" value="{{ old('new_confirm_password') }}">
                                        @error('new_confirm_password')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
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

@section('script')

<script>
    
    $(document).ready(function() {
        $('.bt_clear').on('click', function() {
            $('#ff')[0].reset();
            $('.select2').select2().reset();
        });
    });
</script>
@endsection
