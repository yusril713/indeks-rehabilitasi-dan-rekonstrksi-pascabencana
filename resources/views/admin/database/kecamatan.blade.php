@extends('layouts.admin')
@section('title')
    Form Data Kecamatan
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Form Data Kecamatan
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Index</li>
            <li class="active">Form Data Kecamatan</li>
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
                <h3 class="box-title">Form Data Kecamatan</h3>
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
                            <th>Kecamatan</th>
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
                    const dataGroup = data.keterangan_tempat.reduce((acc, value) => {
                        // Group initialization
                        if (!acc[value.kecamatan]) {
                            acc[value.kecamatan] = [];
                        }

                        // Grouping
                        acc[value.kecamatan].push(value);

                        return acc;
                    }, {});

                    // console.log(dataGroup)
                    $('#tb_responden tbody').empty();
                    $('#kecamatan')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="">Pilih Kecamatan</option>')
                        .val('');

                    var html =''
                    var no = 1
                    for (i in dataGroup) {
                        console.log(dataGroup[i][0].kec.nama)
                        html += '<tr><td rowspan="'+ dataGroup[i].length +'">' + no + '</td>'
                        html += '<td rowspan="'+ dataGroup[i].length +'">' + dataGroup[i][0].kec.nama + "</td>"
                        var sub = 1
                        var url_href = "{{ url('database/detail-kecamatan') }}" + "/" + dataGroup[i][0].kec.id
                        for (j = 0; j < dataGroup[i].length; j++) {
                            if (j == 0) {
                                html += '<td>' + no + '.' + (sub++) + ' '    + dataGroup[i][j].kel.nama + '</td>';
                                html += '<td rowspan="' + dataGroup[i].length + '"><a href="'+url_href+'" class="btn btn-success">Lihat Data</a></td>'
                            } else {
                                html += '<tr><td>' + no + '.' + (sub++) + ' '    + dataGroup[i][j].kel.nama + '</td></tr>'
                            }
                        }
                        html += '/tr>'
                        no++
                    }
                    $('#tb_responden tbody').append(html)
                }
            });
        });
    });
</script>
@endsection
