@extends('layouts.admin')
@section('title')
    {{ $sektor->jenis }}
@endsection

@section('content')
@php
    $yearSurveiMin1 = $survei->keterangan_tempat->tahun_bencana - 1;
    $currentYear = date('Y');
@endphp
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {{ $sektor->jenis }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">{{ $sektor->jenis }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('survei.sektor-pemukiman', [Crypt::encrypt($survei->id), Crypt::encrypt(1)]) }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="form_pemukiman" action="{{ route('sektor-infrastruktur.store',  [Crypt::encrypt($survei->id), Crypt::encrypt(3), 'sektor-sosial']) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="table table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="vcenter" style="vertical-align: middle; ">{{ $sektor->jenis }}</th>
                                            @for ($i = $yearSurveiMin1; $i <= $currentYear; $i++)
                                                <th style="">{{ $i }}</th>
                                            @endfor
                                            <tr>
                                                <th style="vertical-align: middle; ">Sebelum</th>
                                                <th style="vertical-align: middle; ">Saat</th>
                                                @if ($currentYear > Carbon\Carbon::createFromFormat('Y-m-d', $survei->tgl_survei)->year)
                                                <th style="vertical-align: middle; " colspan="{{ $currentYear - Carbon\Carbon::createFromFormat('Y-m-d', $survei->tgl_survei)->year }}">Pasca Bencana</th>
                                                @endif
                                            </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sektor->sektor as $iSektor)
                                            <tr>
                                                <th colspan="{{ $currentYear - Carbon\Carbon::createFromFormat('Y-m-d', $survei->tgl_survei)->year + 3 }}">{{ $iSektor->sektor }}</th>
                                            </tr>
                                            @foreach ($iSektor->pemulihan_sektor as $item)
                                                <tr>
                                                    
                                                    <td class="">{{ $item->pertanyaan }} <br> <p class="text-sm text-danger">{{ $item->keterangan }}</p></td>
                                                    @for ($i = $yearSurveiMin1; $i <= $currentYear; $i++)
                                                    <input type="hidden" name="survei_id[]" value="{{ $survei->id }}">
                                                    <input type="hidden" name="kuesioner_id[]" value="{{ $survei->id }}">
                                                    <input type="hidden" name="tahun[]" value="{{ $i }}">
                                                        <td class=""><input type="text" id="{{ $survei->id }}{{ $item->id }}{{ $i }}" name="nilai[]" data-survei_id="{{ $survei->id }}" data-kuesioner_id="{{ $item->id }}" data-tahun="{{ $i }}" class="form-control nilai" value="{{ count($detail_survei->where('kuesioner_id', $item->id)->where('tahun', $i)) > 0 ? $detail_survei->where('kuesioner_id', $item->id)->where('tahun', $i)->first()->nilai : ''}}"></td>
                                                    @endfor
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer pull-right">
                                <button type="submit" class="btn btn-success">Next</button>
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
    $(document).ready(function() {
        $('.nilai').on('keyup', function() {
            kuesioner_id = $(this).data('kuesioner_id');
            tahun = $(this).data('tahun');
            survei_id = $(this).data('survei_id')
            nilai = $(this).val();
            console.log(kuesioner_id);
            $inputs = $('#form_pemukiman').find("input, select, button, textarea")

            if (nilai == "") {

            } else {

                data = {
                    '_token': "{{ csrf_token() }}",
                    'kuesioner_id': kuesioner_id,
                    'survei_id': survei_id,
                    'tahun': tahun,
                    'nilai': nilai,
                };
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/kinerja-pemulihan/post') }}",
                    data: data,
                    beforeSend: function(){
                         $inputs.prop("disabled", true);
                    },
                    success: function(data) {
                        $("input, select, button, textarea").removeAttr("disabled");
                    }, error: function(xhr) {
                        $("input, select, button, textarea").removeAttr("disabled");
                        if (nilai == null || nilai == ""){}
                        else 
                        alert('Gagal menyimpan data')
                        $('#'+survei_id+kuesioner_id+tahun).val("")
                    }
                });
            }
        });
    });
</script>
<script>
    $(".nilai").on("keypress keyup blur",function (event) {
         //this.value = this.value.replace(/[^0-9\.]/g,'');
        $(this).val($(this).val().replace(/[^0-9\.]/g,''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $(".nilai").on("keypress keyup blur",function (event) {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
</script>
@endsection
