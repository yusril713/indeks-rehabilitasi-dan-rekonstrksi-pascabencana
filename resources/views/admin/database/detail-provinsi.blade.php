@extends('layouts.admin')
@section('title')
    Detail Provinsi
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
@php
    $baseline = '';
@endphp
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Detail Provinsi
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Detail Provinsi</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <div class="box-tools pull-right" style="padding-bottom: 10px;">
                    <a href="#" id="print" class="btn btn-success btn-sm"><i class="fa fa-print"></i>&nbsp; Print</a>
                </div>
            </section>
            <section class="col-lg-4 connectedSortable" >
                <div class="box box-success" id="printArea1">
                    <div class="box-header with-border">
                        <h3 class="box-title">Detail Provinsi {{ $provinsi->nama }}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table borderless">
                            <tr>
                                <td>Kabupaten</td>
                                <td>:</td>
                                <td>{{ $provinsi->nama }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Responden</td>
                                <td>:</td>
                                <td>{{ $jumlah_responden }}</td>
                            </tr>
                            <tr>
                                <td>Tahun</td>
                                <td>:</td>
                                <td>
                                    <select name="tahun" id="tahun" class="form-control">
                                        @foreach ($tahun as $i)
                                            <option value="{{ $i->tahun }}">{{ $i->tahun }}</option>
                                            @php
                                                $baseline = $i->tahun;
                                            @endphp
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            @php
                                $indeks = 0;
                            @endphp
                            @foreach ($ina_pdri as $item)
                                <tr>
                                    <td>Sektor {{ $sektor[$indeks] }} (Nilai)</td>
                                    <td>:</td>
                                    <td id="{{ str_replace(" ", "",$sektor[$indeks]) }}">{{ round($item->hasil, 2) }} - {{$item->hasil >= 100 ? "Pulih" : "Belum Pulih"}}</td>
                                    @php
                                        $indeks++;
                                    @endphp
                                </tr>
                            @endforeach
                            <tr>
                                <td><b>Kesimpulan</b></td>
                                <td>: </td>
                                <td id="rata_rata"></td>
                            </tr>
                        </table>
                    </div>
                </div>

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
            </section>

            <section class="col-lg-8 connectedSortable">
                <div class="box box-danger" id="printArea3">
                    <div class="box-header with-border">
                        <h3 class="box-title">Indeks Pemulihan Sektor</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
@endsection

@section('script')
<script src="{{ asset('js/print.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script>
$('#print').click(function() {
    printContent()
})

function printContent(pid) {
    document.getElementById('printArea1').disabled = !(pid === 'printArea1');
    document.getElementById('printArea2').disabled = !(pid === 'printArea2');
    document.getElementById('printArea3').disabled = !(pid === 'printArea3');
    window.print();
    return false;
}
function printForm() {
	printJS({
    printable: 'printable',
    type: 'html',
    targetStyles: ['*'],
    // header: 'PrintJS - Print Form With Customized Header'
 })
}

$(document).ready(function () {
    var url = "{{ url('database/detail-provinsi-ajax') }}/" + "{{ $provinsi->id }}" + "/" + $('#tahun').val()
    ajaxChart(url)

    $('#tahun').change(function () {
        var url = "{{ url('database/detail-provinsi-ajax') }}/" + "{{ $provinsi->id }}" + "/" + $(this).val()
        console.log(url)
        ajaxChart(url)
    })

    function ajaxChart(url) {
        var tahun_baseline = "{{ $baseline }}"
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(arrObject) {
                // console.log(arrObject.ina_pdri.length)
                indeks = 0;
                // console.log(arrObject.ina_pdri[arrObject.ina_pdri.length-1].tahun);
                var sum = 0
                $.each(arrObject.ina_pdri, function(key, value) {
                    $('#' + arrObject.sektor[indeks].replace(" ", "")).html(
                        "<td>"
                        + value.hasil.toFixed(2) + " - " +(value.tahun == tahun_baseline ? "Baseline" : (value.hasil >= 100 ? "Pulih":"Belum Pulih")) +
                        "</td>"
                    )
                    sum += parseFloat(value.hasil.toFixed(2))
                    indeks++;
                })
                $('#rata_rata').html("<b>" + (sum/5).toFixed(2) + " - " + (  $('#tahun').val() == tahun_baseline ? "Baseline" : ((sum/5) >= 100 ? "Pulih":"Belum Pulih")) + "</b>")

                labels = []
                label = []
                data = []
                temp = '';
                for (i in arrObject.ina_pdri_all) {
                    if(arrObject.ina_pdri_all[i].jenis_sektor.jenis == temp) {
                    } else
                        labels.push(arrObject.ina_pdri_all[i].jenis_sektor.jenis);
                    label.push(arrObject.ina_pdri_all[i].tahun)
                    temp = arrObject.ina_pdri_all[i].jenis_sektor.jenis
                }
                label = getUnique(label)
                // console.log(label)
                var groups = { };
                arrObject.ina_pdri_all.forEach(function(item){
                    var list = groups[item.tahun];
                    if(list){
                        list.push(item);
                    } else{
                        groups[item.tahun] = [item];
                    }
                });
                // console.log(groups)
                avg = []
                var color = ['green', 'red', 'yellow', 'orange', 'blue']
                for (i = 0; i < label.length; i++) {
                    // console.log(groups[label[i]]);
                    data[i] = []
                    temp = 0
                    for (j = 0; j < groups[label[i]].length; j++) {
                        // console.log(groups[label[i]][j].ina_pdri);
                        data[i][j] = parseFloat(groups[label[i]][j].hasil).toFixed(2)
                        temp += groups[label[i]][j].hasil
                    }
                    avg.push(temp / groups[label[i]].length)
                    // color.push(random_rgba())
                }
                console.log(avg)
                datasets = []

                for (i = 0; i < label.length; i++) {
                    datasets.push({
                        // label               : label[i],
                        // fillColor           : color[i],
                        // strokeColor         : color[i],
                        // pointColor          : color[i],
                        // pointStrokeColor    : '#c1c7d1',
                        // pointHighlightFill  : '#fff',
                        // pointHighlightStroke: 'rgba(220,220,220,1)',
                        // data                : data[i],
                        // display             : true
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
                        text: 'Indeks Pemulihan Sektor Kelurahan {{ $provinsi->nama}}'
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


                //Doughnut Chart
                // console.log(label)
                // var chart = new Chart(ctx, {
                // type: 'doughnut',
                // data: {
                //     labels: label,
                //     datasets: [{
                //         data: avg,
                //         backgroundColor: color,
                //         borderColor: color
                //     }]
                // },
                // options: {
                //     responsive: true,
                //     legend: false,
                //     legendCallback: function(chart) {
                //         var ul = document.createElement('ul');
                //         var borderColor = chart.data.datasets[0].borderColor;
                //         chart.data.labels.forEach(function(label, index) {
                //             ul.innerHTML += `
                //                 <li>
                //                 <span style="background-color: ${borderColor[index]}"></span>
                //                 ${label}
                //             </li>
                //             `; // ^ ES6 Template String
                //         });
                //         return ul.outerHTML;
                //     }
                // }
                // });

                // legend.innerHTML = chart.generateLegend();
                //-------------
    //- DONUT CHART -
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
           },
           error: function(xhr) {
               console.log(xhr)
           }
        })
    }
    function random_rgba() {
        var o = Math.round, r = Math.random, s = 255;
        return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
    }
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
