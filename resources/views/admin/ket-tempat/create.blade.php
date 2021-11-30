@extends('layouts.admin')
@section('title')
    Tambah Keterangan Tempat
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Keterangan Tempat
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('keterangan-tempat.index') }}"> Keterangan Tempat</a></li>
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
                <h3 class="box-title">Tambah Keterangan Tempat</h3>

                {{-- <div class="box-tools pull-right">
                    <a href="{{ route('keterangan-tempat.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
                </div> --}}
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-5 col-md-offset-3">
                        <form id="ff" action="{{ $edit ? route('keterangan-tempat.update', [Crypt::encrypt($data->id)]) : route('keterangan-tempat.store') }}" class="form-horizontal" method="post">
                            @csrf
                            @if ($edit)
                                @method('PUT')
                            @endif
                            <input type="hidden" name="prov_id" id="prov_id" value="{{ !$edit ? old('prov_id') :  $data->prov->id }}">
                            <input type="hidden" name="kab_id" id="kab_id" value="{{ !$edit  ? old('kab_id') :  $data->kab->id  }}">
                            <input type="hidden" name="kec_id" id="kec_id" value="{{ !$edit  ? old('kec_id') : $data->kec->id }}">
                            <input type="hidden" name="kel_id" id="kel_id" value="{{ !$edit  ? old('kel_id') : $data->kel->id }}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="kabupaten" class="col-sm-4 control-label">Jenis Bencana</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2 @error('jenis_bencana') is-invalid @enderror" id="jenis_bencana" name="jenis_bencana">
                                            <option value="">Pilih Bencana</option>
                                            @foreach ($bencana as $item)
                                                <option value="{{ $item->id }} {{ $item->jenis_bencana }}" {{ !$edit ? (old('jenis_bencana') == $item->jenis_bencana ? 'selected' : '') : ($data->id == $item->id ? 'selected' : '')  }}>{{ $item->jenis_bencana }} - {{ $item->kec->nama }}, {{ $item->kel->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenis_bencana')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- @livewire('admin.country') --}}
                                <div class="form-group">
                                    <label for="provinsi" class="col-sm-4 control-label">Provinsi</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="provinsi" id="provinsi" class="form-control" readonly>
                                        @error('provinsi')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kabupaten" class="col-sm-4 control-label">Kabupaten/ Kota</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="kabupaten" id="kabupaten" readonly>
                                        @error('kabupaten')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label for="kecamatan" class="col-sm-4 control-label">Kecamatan</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="kecamatan" id="kecamatan" class="form-control" readonly>
                                        @error('kecamatan')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label for="kelurahan" class="col-sm-4 control-label">Desa/ Kelurahan</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="kelurahan" id="kelurahan" class="form-control" readonly>
                                        @error('kelurahan')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="alamat" class="col-sm-4 control-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" cols="30" rows="3">{{ !$edit ? old('alamat') : $data->alamat }}</textarea>
                                        @error('alamat')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kabupaten" class="col-sm-4 control-label">Tahun Terjadi Bencana</label>
                                    <div class="col-sm-8">
                                        <select class="form-control @error('tahun_bencana') is-invalid @enderror" id="tahun_bencana" name="tahun_bencana">
                                            <option selected value="">Pilih Tahun</option>
                                            @for ($i = date('Y'); $i >= 2012; $i--)
                                                <option value="{{ $i }}" {{ !$edit ? (old('tahun_bencana') == $i ? 'selected' : '') : ($data->tahun_bencana == $i ? 'selected' : '') }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('tahun_bencana')
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
                                    <a href="{{ route('keterangan-tempat.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
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
        id = $('#jenis_bencana').val().split(" ")
            var url = "{{ url('keterangan_tempat/get-bencana') }}/" + id[0];
            ajaxGet(url)

        $('#jenis_bencana').change(function () {
            id = $(this).val().split(" ")
            var url = "{{ url('keterangan_tempat/get-bencana') }}/" + id[0];
            ajaxGet(url)
        }) 

        // Initialize Select2 Elements

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

    function ajaxGet(url) {
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(data) {
                console.log(data)
                $('#provinsi').val(data.prov.nama)
                $('#kabupaten').val(data.kab.nama)
                $('#kecamatan').val(data.kec.nama)
                $('#kelurahan').val(data.kel.nama)
                $('#alamat').text(data.alamat)

                $('#prov_id').val(data.prov.id)
                $('#kab_id').val(data.kab.id)
                $('#kec_id').val(data.kec.id)
                $('#kel_id').val(data.kel.id)
            }
        })
    }
</script>
@endsection
