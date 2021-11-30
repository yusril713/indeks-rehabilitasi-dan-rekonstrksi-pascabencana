@extends('layouts.admin')
@section('title')
    Form Data Kelurahan
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Form Data Kelurahan
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Index</li>
            <li class="active">Form Data Kelurahan</li>
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
                <h3 class="box-title">Form Data Kelurahan</h3>
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


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="kecamatan" id="kecamatan" class="form-control">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                <div class="box-body table-responsive">


                    <table id="tb_responden" class="table table-bordered table-striped table-hover">
                        <thead>
                            <th>No</th>
                            <th>Kelurahan</th>
                            <th>Keterangan</th>
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
        const SEKTOR = ["Pemukiman", "INFRASTRUKTUR", "SOSIAL", "EKONOMI", "LINTAS SEKTOR"]
        $('#provinsi').change(function() {
            $('#kecamatan')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Pilih Kecamatan</option>')
                .val('');

            var prov_id = $(this).val();
            var url = "{{ url('database/get-kabupaten') }}" + "/" + prov_id;
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
                }
            })
        });

        $('#kabupaten').change(function() {
            var kab_id = $(this).val();
            var url = "{{ url('database/get-kecamatan') }}" + "/" + kab_id;
            console.log(url)
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

                    $.each(data.kec, function(key, value)
                    {
                        $("#kecamatan").append('<option value=' + value.id + '>' + value.nama + '</option>');
                    });
                }
            });
        });

        $('#kecamatan').change(function() {
            $('#tb_responden tbody').empty();
            var kecamatan_id = $(this).val();
            var url = "{{ url('database/get-kelurahann') }}" + "/" + kecamatan_id;
            console.log(url)
            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                success: function(data) {
                        var no = 1
                    $.each(data.keterangan_tempat, function(key, value)
                    {
                        var url_href = "{{ url('database/detail-kelurahan') }}" + "/" + value.kel.id
                        // $("#kelurahan").append('<option value=' + value.kel.id + '>' + value.kel.nama + '</option>');
                        $('#tb_responden tbody').append(
                            "<tr><td>" + (no++) + "</td><td>" + value.kel.nama + "</td><td><a href='" + url_href + "' class='btn btn-primary btn-sm'>Detail</a></td></tr>"
                        );
                    });
                }
            });
        });

        $('#kelurahan').change(function() {
            $('#tb_responden tbody').empty();
            var kel_id = $(this).val();
            var url = "{{ url('database/kelurahan/find/') }}" + "/" + kel_id;
            $.ajax({
                type:"GET",
                dataType: "json",
                url: url,
                success:function(data) {
                    html = '';
                    for (i in data.ina_pdri) {
                        // console.log(data.ina_pdri[i][0].hasil);
                        html += '<tr>'

                        html += '<td rowspan="'+data.ina_pdri[i].length +'">' + SEKTOR[i-1] + '</td>'

                        for (j = 0; j < data.ina_pdri[i].length; j++) {

                            if (j == 0) {
                                html += '<td>' + data.ina_pdri[i][j].tahun + '</td>'
                                html += '<td>' + data.ina_pdri[i][j].hasil.toFixed(2) + '</td>'
                                html += '<td>' + (data.ina_pdri[i][j].hasil >= 100 ? 'PULIH' : 'BELUM PULIH') + '</td>'
                                // if (i == 1)
                                //     html += '<td rowspan="'+(data.ina_pdri[i].length * 5)  +'"><a href="" class="btn btn-primary btn-sm">Detail</a><a href="" class="btn btn-success btn-sm">Print</a></td>'
                            } else {
                                html += '<tr>'
                                html += '<td>' + data.ina_pdri[i][j].tahun + '</td>'
                                html += '<td>' + data.ina_pdri[i][j].hasil.toFixed(2) + '</td>'
                                html += '<td>' + (data.ina_pdri[i][j].hasil >= 100 ? 'PULIH' : 'BELUM PULIH') + '</td>'
                                html += '</tr>'
                            }
                            console.log(data.ina_pdri[i][j].hasil);
                        }
                             html += '</tr>'
                    }
                    $('#tb_responden tbody').append(html)
                }
            })
        })
    });
</script>
@endsection
