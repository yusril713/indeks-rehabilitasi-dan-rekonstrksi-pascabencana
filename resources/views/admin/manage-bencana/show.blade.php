@extends('layouts.admin')
@section('title')
    {{ $bencana->jenis_bencana }}
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Bencana
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('manage-bencana.index') }}"> Bencana</a></li>
            <li class="active">Lihat</li>
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
                <h3 class="box-title">Lihat Bencana</h3>

                {{-- <div class="box-tools pull-right">
                    <a href="{{ route('manage-bencana.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
                </div> --}}
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>
                                <td style="width: 250px;">Provinsi</td>
                                <td style="width: 10px;">:</td>
                                <td>{{ $bencana->prov->nama }}</td>
                            </tr>
                            <tr>
                                <td style="width: 250px;">Kabupaten/ Kota</td>
                                <td style="width: 10px;">:</td>
                                <td>{{ $bencana->kab->nama }}</td>
                            </tr>
                            <tr>
                                <td style="width: 250px;">Kecamatan</td>
                                <td style="width: 10px;">:</td>
                                <td>{{ $bencana->kec->nama }}</td>
                            </tr>
                            <tr>
                                <td style="width: 250px;">Kelurahan/ Desa</td>
                                <td style="width: 10px;">:</td>
                                <td>{{ $bencana->kel->nama }}</td>
                            </tr>
                            <tr>
                                <td style="width: 250px;">Alamat</td>
                                <td style="width: 10px;">:</td>
                                <td>{{ $bencana->alamat }}</td>
                            </tr>
                      </table>

                      <hr style="background: orange; height: 1.5px; border-radius: 10px">

                      <table class="table table-striped table-hover">
                            <tr>
                                <td style="width: 250px;">Jenis Bencana</td>
                                <td style="width: 10px;">:</td>
                                <td>{{ $bencana->jenis_bencana }}</td>
                            </tr>
                            <tr>
                                <td style="width: 250px;">Keterangan</td>
                                <td style="width: 10px;">:</td>
                                <td>{{ $bencana->ket }}</td>
                            </tr>
                            <tr>
                                <td style="width: 250px;">Tanggal</td>
                                <td style="width: 10px;">:</td>
                                <td>{{ date('d-m-Y', strtotime($bencana->tgl_bencana)) }}</td>
                            </tr>
                            <tr>
                                <td style="width: 250px;">Jam</td>
                                <td style="width: 10px;">:</td>
                                <td>{{ date('H:i A', strtotime($bencana->jam_bencana)) }}</td>
                            </tr>
                        </table>
                      
                    </div>

                    <div class="col-md-6 table-responsive">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            {{-- <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            </ol> --}}
                        
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                @php
                                    $key = 0;
                                @endphp
                                @foreach ($bencana->foto as $slider)
                                    <div class="item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ url('images/upload/'.$slider->nama) }}" alt="{{ $slider->nama }}" style="width:100%;">
                                    </div>
                                    @php
                                        $key++;
                                    @endphp
                                @endforeach
                            </div>
                        
                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-tools pull-left">
                    <a href="{{ route('manage-bencana.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
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
        $('#provinsi').change(function() {
            var prov = $(this).val();
            //console.log(prov);

            url = "{{ url('get-kab') }}" + "/" + prov;
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#kabupaten').empty();
                    $('#kabupaten').append('<option selected>Pilih Kabupaten</option>');
                    $.each(data, function(key, value) {
                        $('#kabupaten').append('<option value="'+ value.id +'" {{ (old('kabupaten') == ('+ value.id +')) ? 'selected' : '' }}>'+ value.nama +'</option>');
                    });
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        });

        $('#kabupaten').change(function() {
            var kab = $(this).val();
            //console.log(kab);

            url = "{{ url('get-kec') }}" + "/" + kab;
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#kecamatan').empty();
                    $('#kecamatan').append('<option selected>Pilih Kecamatan</option>');
                    $.each(data, function(key, value) {
                        $('#kecamatan').append('<option value="'+ value.id +'" {{ (old('kecamatan') == ('+ value.id +')) ? 'selected' : '' }}>'+ value.nama +'</option>');
                    });
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        });

        $('#kecamatan').change(function() {
            var kec = $(this).val();
            //console.log(kec);

            url = "{{ url('get-kel') }}" + "/" + kec;
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#kelurahan').empty();
                    $('#kelurahan').append('<option selected>Pilih Desa</option>');
                    $.each(data, function(key, value) {
                        $('#kelurahan').append('<option value="'+ value.id +'" {{ (old('kelurahan') == ('+ value.id +')) ? 'selected' : '' }}>'+ value.nama +'</option>');
                    });
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        });

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
