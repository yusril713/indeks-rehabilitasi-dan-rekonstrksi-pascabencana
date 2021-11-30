@extends('layouts.admin')
@section('title')
    Proses Perhitungan Indeks RR
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Proses Perhitungan Indeks RR
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Index</li>
            <li class="active">Proses Perhitungan Indeks RR</li>
        </ol>
    </section>


    <section class="content">
        @if (session('status'))
            <script>
                Swal.fire(
                    'Messages!',
                    'Data successfully created...',
                    'success'
                );
            </script>
        @endif
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Proses Perhitungan Indeks RR</h3>

                <div class="box-tools pull-right">
                    <input type="text" name="search" id="" class="form-control" placeholder="Search">
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="provinsi" id="provinsi" class="form-control">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinsi as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="kabupaten" id="kabupaten" class="form-control">
                                <option value="">Pilih Kabupaten</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive">


                    <table id="tb_responden" class="table table-bordered table-striped table-hover">
                        <thead>
                            <th>No</th>
                            <th>Kabupaten</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Nama Responden</th>
                            <th></th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#provinsi').change(function() {
            $('#kecamatan')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Pilih Kecamatan</option>')
                .val('');

            var prov_id = $(this).val();
            var url = "{{ url('manage-process/get-kabupaten') }}" + "/" + prov_id;
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function(data) {

                    $('#tb_responden tbody').empty();
                    $('#kabupaten')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="">Pilih Kabupaten</option>')
                        .val('');

                    $.each(data.kab, function(key, value)
                    {
                        $("#kabupaten").append('<option value=' + value.id + '>' + value.nama + '</option>');
                    });
                    var no = 1
                    $.each(data.ket_tempat, function(key, value) {

                        var url_hitung = "{{ url('manage-process/hitung') }}" + "/" + value.id;
                        $('#tb_responden tbody').append(
                            "<tr><td>" + (no++) + "</td><td>" + value.kab.nama + "</td><td>" + value.kab.nama + "</td><td>" + value.kec.nama + "</td><td>"
                                + value.kel.nama + "</td><td>" + value.petugas_responden.nama_responden
                                + "</td><td><a href='" + url_hitung + "' class='btn btn-primary btn-sm'>Hitung</a></td></tr>"
                        );
                    });
                }
            })
        });

        $('#kabupaten').change(function() {
            var kab_id = $(this).val();
            var url = "{{ url('manage-process/get-kecamatan') }}" + "/" + kab_id;
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: url,
                success: function(data){
                    $('#tb_responden tbody').empty();
                    $('#kecamatan')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="">Pilih Kecamatan</option>')
                        .val('');
                    var no = 1
                    $.each(data.kec, function(key, value)
                    {
                        $("#kecamatan").append('<option value=' + value.id + '>' + value.nama + '</option>');
                    });

                    $.each(data.ket_tempat, function(key, value) {
                        var url_hitung = "{{ url('manage-process/hitung') }}" + "/" + value.id;
                        $('#tb_responden tbody').append(
                            "<tr><td>" + (no++) + "</td><td>" + value.kab.nama + "</td><td>" + value.kec.nama + "</td><td>"
                                + value.kel.nama + "</td><td>" + value.petugas_responden.nama_responden
                                + "</td><td><a href='" + url_hitung + "' class='btn btn-primary btn-sm'>Hitung</a></td></tr>"
                        );
                    });
                }
            });
        });

        $('#kecamatan').change(function() {
            $('#tb_responden tbody').empty();
            var kecamatan_id = $(this).val();
            var url = "{{ url('manage-process/find') }}" + "/" + kecamatan_id;
            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                success: function(data) {
                    console.log(data)
                    var no = 1
                    $.each(data.ket_tempat, function(key, value) {
                        var url_hitung = "{{ url('manage-process/hitung') }}" + "/" + value.id;
                        $('#tb_responden tbody').append(
                            "<tr><td>" + (no++) + "</td><td>" + value.kab.nama + "</td><td>" + value.kab.nama + "</td><td>" + value.kec.nama + "</td><td>"
                                + value.kel.nama + "</td><td>" + value.petugas_responden.nama_responden
                                + "</td><td><a href='" + url_hitung + "' class='btn btn-primary btn-sm'>Hitung</a></td></tr>"
                        );
                    });
                }
            });
        });
    });
</script>
@endsection
