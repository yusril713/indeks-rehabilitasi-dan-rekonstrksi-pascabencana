@extends('layouts.admin')
@section('title')
    Data Foto Bencana
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Foto Bencana
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Index</li>
            <li class="active">Data Foto Bencana</li>
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
                <h3 class="box-title">Data Foto Bencana</h3>

                <div class="box-tools pull-right">
                    <a href="{{ route('manage-foto.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table id="tb" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px">No.</th>
                            <th>Jenis Bencana</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach ($data as $key => $item)   
                            <tr>
                                
                                @php
                                    $counter = 0;
                                @endphp
                                @foreach ($item as $j)    
                                    @if ($counter == 0)
                                        <td rowspan="{{ sizeof($item) }}">{{ $i++ }}</td>
                                        <td rowspan="{{ sizeof($item) }}">{{ $key }}</td>
                                        <td>
                                            <img src="{{ url('images/upload/'.$j->nama) }}" alt="" width="200" height="auto">    
                                        </td>
                                
                                        <th rowspan="{{ sizeof($item) }}">
                                            <form action="{{ route('manage-foto.destroy', [Crypt::encrypt($j->id)]) }}" method="post" onsubmit="return confirm('Are you sure want to remove this data {{ $key }}?')" style="display: inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                            </form>
                                        </th>
                                    @else
                                        <tr>
                                            <td>
                                                <img src="{{ url('images/upload/'.$j->nama) }}" alt="" width="200" height="auto">    
                                            </td>
                                        </tr>
                                    @endif        
                                    @php
                                        $counter++;
                                    @endphp
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </section>
</div>
@endsection
