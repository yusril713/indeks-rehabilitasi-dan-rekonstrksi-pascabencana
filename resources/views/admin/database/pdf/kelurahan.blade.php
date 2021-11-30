
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ina PDRI - BNPB</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Icon -->
    <link rel="icon" type="image/png" href="{{ asset('styles/images/logo/logo.png') }}"/>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('styles/plugins/iCheck/all.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{ asset('styles/plugins/timepicker/bootstrap-timepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('styles/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('styles/css/skins/_all-skins.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('styles/plugins/iCheck/flat/blue.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('styles/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap" rel="stylesheet">
    <!-- Preload -->
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/css/preload.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/sweetalert2/bootstrap-4.min.css') }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Images --}}
    <link rel="stylesheet" href="{{ asset('vendor/images/image-uploader.min.css') }}">
</head>

<body class="hold-transition skin-yellow fixed sidebar-mini">

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
                Detail Kelurahan
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Detail Kelurahan</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <section class="col-lg-12">
                    <div class="box-tools pull-right" style="padding-bottom: 10px;">
                        <a href="" class="btn btn-success btn-sm"><i class="fa fa-print"></i>&nbsp; Print</a>
                    </div>
                </section>
    
                <section class="col-lg-4 connectedSortable">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Detail Kelurahan {{ $kelurahan->nama }}</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table borderless">
                                <tr>
                                    <td>Kelurahan</td>
                                    <td>:</td>
                                    <td>{{ $kelurahan->nama }}</td>
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
                            </table>
                        </div>
                    </div>
            
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Donut Chart</h3>
                
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
                    <div class="box box-danger">
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

     <!-- ./wrapper -->
    <!-- jQuery 3 -->
    <script src="{{ asset('styles/vendor/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('styles/vendor/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('styles/vendor/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('styles/vendor/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('styles/vendor/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- Morris.js charts -->
    <script src="{{ asset('styles/vendor/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('styles/vendor/bower_components/morris.js/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('styles/vendor/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('styles/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('styles/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('styles/vendor/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('styles/vendor/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('styles/vendor/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('styles/vendor/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('styles/vendor/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('styles/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('styles/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('styles/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('styles/vendor/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('styles/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('styles/vendor/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('styles/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('styles/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('styles/vendor/bower_components/chart.js/Chart.js') }}"></script>
    <script src="{{ asset('styles/vendor/bower_components/chart.js/Chart.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('styles/vendor/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('styles/js/adminlte.min.js') }}"></script>
    {{-- Preloader --}}
    <script src="{{ asset('styles/vendor/preloader.js') }}"></script>
    {{-- Sweetalert2 --}}
    <script src="{{ asset('styles/vendor/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('styles/vendor/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('vendor/images/image-uploader.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tb').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                'responsive'  : true
            })

            $('.datepicker').datepicker({
                singleDatePicker: true,
                showDropdowns: true,
                format: 'yyyy-mm-dd'
            })

            $('.timepicker').timepicker({
                showInputs: false
            })

            $('.select2').select2()
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script>
    $(document).ready(function () {
        var url = "{{ url('database/detail-kelurahan-ajax') }}/" + "{{ $kelurahan->id }}" + "/" + $('#tahun').val()
        ajaxChart(url)
    
        $('#tahun').change(function () {
            var url = "{{ url('database/detail-kelurahan-ajax') }}/" + "{{ $kelurahan->id }}" + "/" + $(this).val()
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
                    $.each(arrObject.ina_pdri, function(key, value) {
                        $('#' + arrObject.sektor[indeks].replace(" ", "")).html(
                            "<td>"
                            + value.hasil.toFixed(2) + " - " +(value.tahun == tahun_baseline ? "Baseline" : (value.hasil >= 100 ? "Pulih":"Belum Pulih")) +
                            "</td>"
                        )
                        indeks++;
                    })
    
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
                            text: 'Indeks Pemulihan Sektor Kelurahan {{ $kelurahan->nama}}'
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
</body>

</html>