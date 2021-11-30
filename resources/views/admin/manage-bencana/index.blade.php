@extends('layouts.admin')
@section('title')
    Data Bencana
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Bencana
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Index</li>
            <li class="active">Data Bencana</li>
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
                <h3 class="box-title">Data Bencana</h3>

                <div class="box-tools pull-right">
                    <a href="{{ route('manage-bencana.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table id="tb" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Provinsi</th>
                            <th>Kabupaten</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Alamat</th>
                            <th>Jenis Bencana</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            {{-- <th>Foto</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1;  @endphp
                        @foreach ($data as $item)
                        <tr>
                            <td style="width: 10px">{{ $i++ }}.</td>
                            <td>{{ $item->prov->nama }}</td>
                            <td>{{ $item->kab->nama }}</td>
                            <td>{{ $item->kec->nama }}</td>
                            <td>{{ $item->kel->nama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->jenis_bencana }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->tgl_bencana)) }}</td>
                            <td>{{ date('H:i A', strtotime($item->jam_bencana)) }}</td>
                            {{-- <td>
                                @foreach ($item->foto->nama as $images)
                                <img src="{{ asset('images/upload/'.$images) }}" alt="" width="100" height="auto">
                                @endforeach
                            </td> --}}
                            <td>
                                @role('Super Admin|Level 3')
                                    <a href="{{ route('manage-bencana.edit', [Crypt::encrypt($item->id)]) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="{{ route('manage-bencana.show', [Crypt::encrypt($item->id)]) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Lihat</a>
                                @else
                                    @if(Auth::user()->id == $item->user_id)
                                    <a href="{{ route('manage-bencana.edit', [Crypt::encrypt($item->id)]) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="{{ route('manage-bencana.show', [Crypt::encrypt($item->id)]) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Lihat</a>
                                    @endif
                                @endrole

                                @can('manage-bencana.destroy')
                                <form action="{{ route('manage-bencana.destroy', [Crypt::encrypt($item->id)]) }}" method="post" onsubmit="return confirm('Are you sure want to remove this data?')" style="display: inline">
                                    @method('DELETE')
                                    @csrf
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
