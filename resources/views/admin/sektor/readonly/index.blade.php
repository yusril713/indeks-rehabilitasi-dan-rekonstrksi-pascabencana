@extends('layouts.admin')
@section('title')
    {{ $sektor->jenis }}
@endsection

@section('content')
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
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @error('nilai.*')
                            <div class="alert alert-danger">
                                {{ 'Pastikan anda telah mengisi nilai di setiap pertanyaan!' }}
                            </div>
                        @enderror
                        <form action="#" method="post">
                            @csrf
                            @method('PUT')
                            <div class="table table-responsive">
                                
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="vcenter" style="vertical-align: middle; ">{{ $sektor->jenis }}</th>
                                            <th>2017</th>
                                            <th>2018</th>
                                            <th>2019</th>
                                            <th>2020</th>
                                            <th>2021</th>
                                            <tr>
                                                <th style="vertical-align: middle; ">Sebelum</th>
                                                <th style="vertical-align: middle; ">Saat</th>
                                                <th>Pasca 1</th>
                                                <th>Pasca 2</th>
                                                <th>Pasca 3</th>
                                            </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sektor->sektor as $iSektor)
                                            <tr>
                                                <th colspan="5">{{ $iSektor->sektor }}</th>
                                                
                                            </tr>
                                            @foreach ($iSektor->pemulihan_sektor as $item)
                                                <tr>
                                                    <td class="">{{ $item->pertanyaan }} <br> <p class="text-sm text-danger">{{ $item->keterangan }}</p></td>

                                                    <td class=""><input type="text" class="form-control" readonly></td>
                                                    <td class=""><input type="text" class="form-control" readonly></td>
                                                    <td class=""><input type="text" class="form-control" readonly></td>
                                                    <td class=""><input type="text" class="form-control" readonly></td>
                                                    <td class=""><input type="text" class="form-control" readonly></td>
                                                    
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
