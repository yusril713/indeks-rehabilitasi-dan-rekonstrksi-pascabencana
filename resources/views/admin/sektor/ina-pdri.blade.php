@extends('layouts.admin')
@section('title')
    Hasil Perhitungan INA-PDRI
@endsection

@section('content')
<style>
    table.borderless td,table.borderless th{
        border: none !important;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Hasil Perhitungan INA-PDRI
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Hasil Perhitungan INA-PDRI</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('survei.sektor-sosial', [Crypt::encrypt($survei->id), Crypt::encrypt(3)]) }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table borderless">
                            <tr>
                                <th>Petugas</th>
                                <th>{{$survei->petugas->nama}}</th>
                            </tr>
                            <tr>
                                <th>Telp</th>
                                <th>{{ $survei->petugas->no_hp }}</th>
                            </tr>
                            <tr>
                                <th>Jenis Bencana</th>
                                <th>{{$survei->keterangan_tempat->jenis_bencana}}</th>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <th>{{ $survei->keterangan_tempat->kel->nama }},
                                    {{ $survei->keterangan_tempat->kec->nama }},
                                    {{ $survei->keterangan_tempat->kab->nama }},
                                    {{ $survei->keterangan_tempat->prov->nama }}
                                </th>
                            </tr>
                            <tr>
                                <th>Tgl Survei</th>
                                <th>{{$survei->tgl_survei}}</th>
                            </tr>
                            <tr>
                                <th>Tgl Periksa</th>
                                <th>{{$survei->tgl_periksa}}</th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table borderless">
                            <tr>
                                <th>Responden</th>
                                <th>{{$survei->nama_responden}}</th>
                            </tr>
                            <tr>
                                <th>Telp</th>
                                <th>{{$survei->no_hp}}</th>
                            </tr>
                            <tr>
                                <th>No Responden</th>
                                <th>{{$survei->no_responden}}</th>
                            </tr>
                            <tr>
                                <th>No Kartu Keluarga</th>
                                <th>{{ $survei->no_kk }}
                                </th>
                            </tr>
                            
                            <tr>
                                <th>Lokasi Asal</th>
                                <th>{{$survei->lokasi_asal}}</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th>Sektor</th>
                                    @foreach ($tahun as $item)
                                        <th>{{ $item->tahun }}</th>
                                    @endforeach
                                </thead>
                                <tbody>
                                    @foreach ($ina_pdri->groupBy('jenis_sektor_id') as $i)
                                    <tr>
                                        <td rowspan="2" style="vertical-align: middle;">{{ $i[0]->jenis_sektor->jenis }}</td>
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @foreach ($i as $j)
                                            <td>{{ $j->ina_pdri }}</td>
                                        @endforeach

                                        <tr>
                                        @foreach ($i as $j)
                                        <td><b>
                                            @if ($counter == 0)
                                                {{ 'Baseline' }}
                                            @else
                                                @if ($j->ina_pdri >= 100)
                                                    {{ 'Pulih' }}
                                                @else
                                                    {{ "Belum Pulih" }}
                                                @endif
                                            @endif
                                        </b></td>
                                        @php
                                            $counter++;
                                        @endphp
                                        @endforeach
                                    </tr>
                                    </tr>
                                        
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