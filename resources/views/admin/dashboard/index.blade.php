@extends('layouts.admin')
@section('title')
    Dashboard
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $user->count() }}</h3>
    
                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>

             <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $keterangan_tempat }}</h3>
    
                    <p>Respondent</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $provinsi }}<sup style="font-size: 20px"></sup></h3>
    
                    <p>Affected Area</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{ $bencana }}<sup style="font-size: 20px"></sup></h3>
    
                    <p>Disasters</p>
                </div>
                <div class="icon">
                    <i class="fa fa-refresh"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <div class="banner-carousel banner-carousel-1 mb-0">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                {{-- <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                </ol> --}}
            
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    @php
                        $key = 0;
                    @endphp
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ url('images/slider-home/slider'.$i.'.jpg') }}" alt="" style="width:100%;">
                        </div>
                        @php
                            $key++;
                        @endphp
                    @endfor
                </div>
            
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
