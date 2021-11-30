@extends('layouts.admin')
@section('title')
    Form Data Provinsi
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Form Data Provinsi
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Index</li>
            <li class="active">Form Data Provinsi</li>
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
                <h3 class="box-title">Form Data Provinsi</h3>
                <hr>

                <div class="box-body table-responsive">
                    <table id="tb_responden" class="table table-bordered table-striped table-hover">

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
        var url = "{{ url('database/get-provinsi') }}" ;
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function(data) {

                // $('#tb_responden').empty();
                const dataGroup = data.keterangan_tempat.reduce((acc, value) => {
                    // Group initialization
                    if (!acc[value.provinsi]) {
                        acc[value.provinsi] = [];
                    }

                    // Grouping
                    acc[value.provinsi].push(value);

                    return acc;
                }, {});
                var html =''
                var no = 1

                html += '<thead><th>No</th><th>Provinsi</th><th>Kabupaten</th><th>Kecamatan</th><th>Kelurahan</th><th>Keterangan</th></thead><tbody>'

                for (var i in dataGroup) {
                    // console.log(dataGroup[i][0].kec.nama)
                    html += '<tr><td rowspan="'+ dataGroup[i].length +'">' + (no) + '</td>'
                    html += '<td rowspan="'+ dataGroup[i].length +'">' + dataGroup[i][0].prov.nama + '</td>'
                    var url_href = "{{ url('database/detail-provinsi') }}" + "/" + dataGroup[i][0].prov.id
                    var sub = 1
                    for (j = 0; j < dataGroup[i].length; j++) {
                        if (j == 0) {
                            html += '<td>' + no + '.' + (sub++) + ' ' + dataGroup[i][j].kab.nama + '</td>';
                            html += '<td>' + dataGroup[i][j].kec.nama + '</td>';
                            html += '<td>' + dataGroup[i][j].kel.nama + '</td>';
                            html += '<td rowspan="' + dataGroup[i].length + '"><a href="'+url_href+'" class="btn btn-success">Lihat Data</a></td>'
                        } else {

                            html += '<tr><td>' + no + '.' + (sub++) + ' '  + dataGroup[i][j].kab.nama + '</td>'
                            html += '<td>' + dataGroup[i][j].kec.nama + '</td>'
                            html += '<td>' + dataGroup[i][j].kel.nama + '</td></tr>'
                        }
                    }
                    no++
                    html += '/tr>'
                }

                html += '</tbody>'
                $('#tb_responden').html(html);
                $('#tb_responden').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                'responsive'  : true
            });
            }
        })
    });
</script>
@endsection
