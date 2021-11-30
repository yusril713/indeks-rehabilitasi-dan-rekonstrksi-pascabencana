@extends('layouts.admin')
@section('title')
    Data Keterangan Tempat
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Keterangan Tempat
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Index</li>
            <li class="active">Data Keterangan Tempat</li>
        </ol>
    </section>


    <section class="content">
        @if ($message = Session::get('success'))
            <script>
                var msg = "{{ $message }}";
                Swal.fire(
                    'Messages',
                    msg,
                    'success'
                );
            </script>
        @endif
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Data Keterangan Tempat</h3>

                <div class="box-tools pull-right">
                    <a href="{{ route('keterangan-tempat.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table id="tb_keterangan_tempat" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Provinsi</th>
                            <th>Kabupaten</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Alamat</th>
                            <th>Tahun Bencana</th>
                            <th>Jenis Bencana</th>
                            <th>Status</th>
                            @can('keterangan-tempat.destroy')
                            <th colspan="2">Action</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @include('admin.ket-tempat.data-kettempat')
                    </tbody>
                </table>
            </div>
            <div class="box-body">
                {{ $data->links() }}
            </div>
        </div>

    </section>
</div>
@endsection

@section('script')
<script>
    $('#tb_keterangan_tempat').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                'responsive'  : true
            })
</script>
@endsection
