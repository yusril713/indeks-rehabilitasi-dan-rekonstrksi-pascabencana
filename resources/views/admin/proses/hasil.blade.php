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

                    <div class="col-md-5">

                        <table class="table borderless">

                            <tr>

                                <td>Petugas</td>

                                <td>:</td>

                                <td>{{$survei->petugas->nama}}</td>

                            </tr>

                            <tr>

                                <td>Telp</td>

                                <td>:</td>

                                <td>{{ $survei->petugas->no_hp }}</td>

                            </tr>

                            <tr>

                                <td>Jenis Bencana</td>

                                <td>:</td>

                                <td>{{$survei->keterangan_tempat->jenis_bencana}}</td>

                            </tr>

                            <tr>

                                <td>Lokasi</td>

                                <td>:</td>

                                <td>{{ $survei->keterangan_tempat->kel->nama }},

                                    {{ $survei->keterangan_tempat->kec->nama }},

                                    {{ $survei->keterangan_tempat->kab->nama }},

                                    {{ $survei->keterangan_tempat->prov->nama }}

                                </td>

                            </tr>

                            <tr>

                                <td>Tgl Survei</td>

                                <td>:</td>

                                <td>{{$survei->tgl_survei}}</td>

                            </tr>

                            <tr>

                                <td>Tgl Periksa</td>

                                <td>:</td>

                                <td>{{$survei->tgl_periksa}}</td>

                            </tr>

                            <tr>

                                <td>Responden</td>

                                <td>:</td>

                                <td>{{$survei->nama_responden}}</td>

                            </tr>

                            <tr>

                                <td>Telp</td>

                                <td>:</td>

                                <td>{{$survei->no_hp}}</td>

                            </tr>

                            <tr>

                                <td>No Responden</td>

                                <td>:</td>

                                <td>{{$survei->no_responden}}</td>

                            </tr>

                            <tr>

                                <td>No Kartu Keluarga</td>

                                <td>:</td>

                                <td>{{ $survei->no_kk }}

                                </td>

                            </tr>

                            

                            <tr>

                                <td>Lokasi Asal</td>

                                <td>:</td>

                                <td>{{$survei->lokasi_asal}}</td>

                            </tr>

                        </table>

                    </div>

                    <div class="col-md-7">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="box box-success">

                                    <div class="box-header with-border">

                                    <h3 class="box-title">Indeks Pemulihan Sektor</h3>

        

                                    <div class="box-tools pull-right">

                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

                                        </button>

                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

                                    </div>

                                    </div>

                                    <div class="box-body">

                                    <div class="chart">

                                        <canvas id="barChart" style="height:230px"></canvas>

                                    </div>

                                    </div>

                                    <!-- /.box-body -->

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12">

                                <!-- DONUT CHART -->

                               
                                <div class="box box-primary" id="printArea2">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Indeks Pemulihan Sektor</h3>
                            
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                                    <!-- /.box-body -->
                            </div>

                        </div>

                    </div>

                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <h4>Hasil Perhitungan INA PDRI</h4>
                        <div class="table table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Sektor</th>
                                        @php
                                            $t = -1;
                                        @endphp
                                        @foreach ($tahun as $item)
                                            <th>{{ $item->tahun }}</th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($tahun as $item)
                                        <th>                                         
                                            @if ($t < 0)
                                            t{{ $t }}                                                                                            
                                            @else
                                                t + {{$t}}
                                            @endif
                                            @php
                                               $t++;
                                            @endphp                                          
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ina_pdri->groupBy('jenis_sektor_id') as $i)
                                    <tr>
                                        <td rowspan="2" style="vertical-align: middle;">{{ $i[0]->jenis_sektor->jenis }}</td>
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @foreach ($i as $j)
                                            <td>{{ round($j->ina_pdri, 2) }}</td>
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



@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script>

$(function () {

    //-------------

    //- BAR CHART -

    //-------------

    var url = "{{ url('/manage-process/chart') }}" + "/{{ $survei->id }}";

    $.ajax({
        type: "GET",
        dataType: "json",
        url: url,
        success: function(arrObject){
            labels = []
            label = []
            data = []
            temp = '';
            for (i in arrObject) {
                if(arrObject[i].jenis_sektor.jenis == temp) {
                    
                } else
                    labels.push(arrObject[i].jenis_sektor.jenis);
                label.push(arrObject[i].tahun)
                temp = arrObject[i].jenis_sektor.jenis
            }
            label = getUnique(label)
            var groups = { };
            arrObject.forEach(function(item){
                var list = groups[item.tahun];
                if(list){
                    list.push(item);
                } else{
                    groups[item.tahun] = [item];
                }
            });
            // console.log(groups)
            avg = []
            for (i = 0; i < label.length; i++) {
                // console.log(groups[label[i]]);
                data[i] = []
                temp = 0
                for (j = 0; j < groups[label[i]].length; j++) {
                    // console.log(groups[label[i]][j].ina_pdri);
                    data[i][j] = parseFloat(groups[label[i]][j].ina_pdri).toFixed(2) 
                    temp += groups[label[i]][j].ina_pdri
                }
                avg.push(temp / groups[label[i]].length)
            }

            datasets = []
            var color = ['green', 'red', 'yellow', 'orange', 'blue']
            for (i = 0; i < label.length; i++) {
                datasets.push({
                    // label               : label[i],
                    // fillColor           : color[i],
                    // strokeColor         : color[i],
                    // pointColor          : color[i],
                    // pointStrokeColor    : '#c1c7d1',
                    // pointHighlightFill  : '#fff',
                    // pointHighlightStroke: 'rgba(220,220,220,1)',
                    // data                : data[i]
                    label: label[i],
                        fill: false,
                        data: data[i],
                        backgroundColor: color[i],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                            'rgba(255,99,132,1)',
                        ],
                        borderWidth: 1
                });
            }


           // console.log(datasets)

           var ctx = document.getElementById("barChart");
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:  ['PEMUKIMAN', 'INFRASTRUKTUR', 'SOSIAL', 'EKONOMI', 'LINTAS SEKTOR'],
                        datasets: datasets,
                    },
                    options: {
                        scales: {
                        yAxes: [{
                            ticks: {
                            beginAtZero: true
                            }
                        }]
                        },
                        title: {
                        display: true,
                        text: 'Indeks Pemulihan Sektor Per Responden'
                        },
                        responsive: true,

                        tooltips: {
                            callbacks: {
                                labelColor: function(tooltipItem, chart) {
                                return {
                                    borderColor: 'rgb(255, 0, 20)',
                                    backgroundColor: 'rgb(255,20, 0)'
                                }
                                }
                            }
                        },
                        legend: {
                            labels: {
                                // This more specific font property overrides the global property
                                fontColor: 'red',

                            }
                        }
                    }
                });


            // console.log(avg);
            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.

            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                var donutData        = {
                labels: label,
                datasets: [
                    {
                    data: avg,
                    backgroundColor : color,
                    }
                ]
                }
                var donutOptions     = {
                maintainAspectRatio : false,
                responsive : true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
                })
        }
    })

    function getUnique(array){
        var uniqueArray = [];

       
        // Loop through array values
        for(i=0; i < array.length; i++){
            if(uniqueArray.indexOf(array[i]) === -1) {
                uniqueArray.push(array[i]);
            }
        }
        return uniqueArray;
    }

})
</script>
@endsection