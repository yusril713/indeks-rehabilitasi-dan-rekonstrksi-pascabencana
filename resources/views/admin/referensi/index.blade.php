@extends('layouts.admin')
@section('title')
    Data Referensi
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Referensi
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Index</li>
            <li class="active">Data Referensi</li>
        </ol>
    </section>


    <section class="content">
        @if (session('status'))
            <script>
                Swal.fire(
                    'Messages',
                    'Data successfully created...',
                    'success'
                );
            </script>
        @endif
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Data Referensi</h3>

                <div class="box-tools pull-right">
                    <a href="{{ route('referensi.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table id="tb" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px">No.</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1;  @endphp
                        @foreach ($referensi as $item) 
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->ket }}</td>
                        
                                <td>
                                    <a href="{{ url('upload/file/'.$item->filedoc) }}" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download</a>
                                    <form action="{{ route('referensi.destroy', [Crypt::encrypt($item->id)]) }}" method="post" onsubmit="return confirm('Are you sure want to remove this data {{ $item->ket }}?')" style="display: inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </section>
</div>
@endsection
