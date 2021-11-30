@extends('layouts.admin')
@section('title')
    Tambah File Referensi
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            File Referensi
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('referensi.index') }}"> File Referensi</a></li>
            <li class="active">Tambah</li>
        </ol>
    </section>


    <section class="content">
        @if (session('status'))
            <script>
                Swal.fire(
                    'Messages',
                    'Your images has been successfully',
                    'success'
                );
            </script>
        @endif
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah File Referensi</h3>

                {{-- <div class="box-tools pull-right">
                    <a href="{{ route('manage-foto.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
                </div> --}}
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-5 col-md-offset-3">
                        <form id="ff" action="{{ route('referensi.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Keterangan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('ket') is-invalid @enderror" id="ket" name="ket" value="{{ old('ket') }}">
                                        @error('ket')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Keterangan</label>
                                    <div class="col-sm-8">
                                        <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror">
                                            <option selected>Pilih Jenis File</option>
                                            <option value="pdf" {{ old('jenis') == 'pdf' ? 'selected' : '' }}>PDF</option>
                                            <option value="word" {{ old('jenis') == 'word' ? 'selected' : '' }}>Word</option>
                                            <option value="images" {{ old('jenis') == 'images' ? 'selected' : '' }}>Images</option>
                                            <option value="zip" {{ old('jenis') == 'zip' ? 'selected' : '' }}>ZIP</option>
                                        </select>
                                        @error('jenis')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="nama" class="col-sm-4 control-label">Masukan File</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control @error('filedoc.*') is-invalid @enderror" name="filedoc[]" id="filedoc" multiple value="{{ old('filedoc.*') }}">
                                        @error('filedoc.*')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-sm-8 col-sm-offset-4">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success btn-sm bt_save"><i class="fa fa-save"></i> Simpan</button>
                                </div>

                                <div class="pull-left">
                                    <a href="{{ route('referensi.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
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
    $(function () {

    });
</script>

<script>
    $(document).ready(function() {
        //Initialize Select2 Elements
        

        $('.bt_save').click(function() {
            $('.alert-danger').fadeIn();
        });

        //$('.alert-danger').fadeOut(5000);
        setTimeout(function(){ $('.alert-danger').fadeOut(); }, 5000);

        $('.bt_clear').click(function() {
            $('#ff')[0].reset();
            $('.select2').select2().reset();
        });
    });
</script>
@endsection
