@extends('layouts.admin')
@section('title')
    Tambah Foto Bencana
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Foto Bencana
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('manage-foto.index') }}"> Foto Bencana</a></li>
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
                <h3 class="box-title">Tambah Foto Bencana</h3>

                {{-- <div class="box-tools pull-right">
                    <a href="{{ route('manage-foto.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
                </div> --}}
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-5 col-md-offset-3">
                        <form id="ff" action="{{ route('manage-foto.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Data Bencana</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2 @error('id_bencana') is-invalid @enderror" id="id_bencana" name="id_bencana">
                                            <option value="" selected>Pilih Jenis Bencana</option>
                                            @foreach ($bencana as $item)
                                                <option value="{{ $item->id }}" {{ old('id_bencana') == $item->id ? 'selected' : '' }}>{{ date('d-m-Y', strtotime($item->tgl_bencana)) }} - {{ $item->jenis_bencana }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_bencana')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="nama" class="col-sm-4 control-label">Masukan Foto</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama">
                                        @error('nama')
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
                                    <a href="{{ route('manage-foto.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
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
