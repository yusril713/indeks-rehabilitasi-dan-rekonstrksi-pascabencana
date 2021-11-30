@extends('layouts.admin')

@section('title')

    Data Galery

@endsection



@section('content')



<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Galery

        </h1>

        <ol class="breadcrumb">

            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li>Index</li>

            <li class="active">Data Gallery</li>

        </ol>

    </section>





    <section class="content">

        <div class="box box-warning">

            <div class="box-header with-border">

                <h3 class="box-title">Data Gallery</h3>

            </div>

            <div class="box-body">

                <div class="row">

                    @php

                        $counter = 1;

                    @endphp

                    @foreach ($foto as $key => $item)

                        @foreach ($item as $j)

                            <div class="col-lg-3 col-xs-6">

                                <div class="small-box">

                                    <div class="gallery">

                                        <a href="{{ url('images/upload/'.$j->nama) }}" data-fancybox="gallery" data-caption="{{ $key }}, {{ $j->bencana->prov->nama }}, {{ $j->bencana->kab->nama }}, {{ $j->bencana->kec->nama }}, {{ $j->bencana->kel->nama }}">

                                            <div class="embed-responsive embed-responsive-16by9">

                                            <img src="{{ url('images/upload/'.$j->nama) }}" class="embed-responsive-item"  style="padding: 2px 2px;" alt="">

                                            </div>

                                        </a>

            

                                        <div class="caption embed-responsive-item">

                                            <p style="color: black">{{ $key }}, {{ $j->bencana->prov->nama }}, {{ $j->bencana->kab->nama }}, {{ $j->bencana->kec->nama }}, {{ $j->bencana->kel->nama }}</p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    @endforeach

            </div>

            </div>

            

        </div>



    </section>

</div>

@endsection



@section('script')

    <script>

        $(document).ready(function() {

            $("[data-fancybox]").fancybox({

                protect: true

            });

        });

    </script>

@endsection

