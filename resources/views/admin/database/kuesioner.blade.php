@extends('layouts.admin')
@section('title')
    Form Data Kuesioner
@endsection

@section('content')
<style>
    table.borderless td,table.borderless th{
        border: none !important;
    }
    .chart-container {
   display: flex;
}

    #legend ul {
    list-style: none;
    font: 12px Verdana;
    white-space: nowrap;
    }

    #legend li span {
    width: 36px;
    height: 12px;
    display: inline-block;
    margin: 0 5px 8px 0;
    vertical-align: -9.4px;
}   
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Form Data Kuesioner
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Index</li>
            <li class="active">Form Data Kuesioner</li>
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
        <div class="box box-warning" id="printable1">
            
            <div class="box-header with-border">
                <div class="box-tools pull-right" style="padding-bottom: 10px;">
                    <a href="#" id="print" class="btn btn-success btn-sm"><i class="fa fa-print"></i>&nbsp; Print</a>
                </div>
                <h3 class="box-title">Form Data Kuesioner</h3>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <table class="table borderless">
                            <tr>
                                <td>No Responden</td>
                                <td>:</td>
                                <td>{{ $responden->no_responden }}</td>
                            </tr>
                            <tr>
                                <td>No Kartu Keluarga</td>
                                <td>:</td>
                                <td>{{ $responden->no_kk }}</td>
                            </tr>
                            <tr>
                                <td>Nama Responden</td>
                                <td>:</td>
                                <td>{{ $responden->nama_responden }}</td>
                            </tr>
                            <tr>
                                <td>Lokasi Asal</td>
                                <td>:</td>
                                <td>{{ $responden->lokasi_asal }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body table-responsive">
                            <table class="table table-striped table-bordered" id="printable2">
                                <thead>
                                    <th></th>
                                    @php
                                        $t = -1;
                                    @endphp
                                    @foreach ($tahun as $item)
                                        @if ($t == -1)
                                            <th>{{ $item->tahun }}<br> t - 1</th>                                        
                                        @else
                                            <th>{{ $item->tahun }} <br> t + {{ $t }}</th>
                                        @endif
                                        @php
                                            $t++;
                                        @endphp
                                    @endforeach
                                </thead>
                                <tbody>
                                    @foreach ($survei as $key => $value)
                                        <tr>
                                            <th>{{ $key }}</th>
                                        </tr>
                                        @foreach ($value as $key2 => $i) 
                                            <tr>
                                                <td><b>{{ $key2 }}</b></td>
                                            </tr>
                                            @foreach ($i as $key3 => $j)
                                            <tr>
                                                <td>{{ $key3 }}</td>
                                                @foreach ($j as $k)            
                                                    <td>{{ $k->nilai }}</td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
<script>
$('#print').click(function() {
    printContent()
})

function printContent(pid) {
    document.getElementById('printable1').disabled = !(pid === 'printable1');
    document.getElementById('printable2').disabled = !(pid === 'printable2');
    window.print();
    return false;
}
</script>
@endsection
                    