@extends('layouts.admin')
@section('title')
    Data Petugas
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Petugas
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Index</li>
            <li class="active">Data Petugas</li>
        </ol>
    </section>


    <section class="content">
        @if (session('status'))
            <script>
                Swal.fire(
                    'Messages!',
                    'Data successfully created...',
                    'success'
                );
            </script>
        @endif
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Data Petugas</h3>
                @can('manage-petugas.create')
                <div class="box-tools pull-right">
                    <a href="{{ route('manage-petugas.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                @endcan
            </div>

            <div class="box-body table-responsive">
                <table id="tb" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>TTL</th>
                            <th>No Hp</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($petugas as $item)
                           <tr>
                               <td>{{ $item->nip }}</td>
                               <td>{{ $item->nama }}</td>
                               <td>{{ isset($item->user->email) ? $item->user->email : '-' }}</td>
                               <td>{{ $item->jenis_kelamin == 'L' ? "Pria" : "Wanita"}}</td>
                               <td>{{ $item->tempat_lahir }}, {{ $item->tgl_lahir }}</td>
                               <td>{{ $item->no_hp }}</td>
                               <td>{{ $item->alamat }}</td>
                               <td>
                                   @role('Super Admin|Level 3')
                                   <a href="{{ route('manage-petugas.edit', [Crypt::encrypt($item->id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                   @else
                                    @if(Auth::user()->id == isset($item->user->id))
                                    <a href="{{ route('manage-petugas.edit', [Crypt::encrypt($item->id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    @endif
                                    @endrole
                                    @can('manage-petugas.destroy')
                                   <form action="{{ route('manage-petugas.destroy', [Crypt::encrypt($item->id)]) }}" method="post" style="display: inline" onsubmit="return confirm('Yakin ingin menghapus data tersebut?')">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                   </form>
                                   @endcan
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
