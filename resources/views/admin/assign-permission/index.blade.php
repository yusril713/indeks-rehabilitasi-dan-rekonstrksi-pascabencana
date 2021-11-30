@extends('layouts.admin')
@section('title')
    Data Assign Permission
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Assign Permission
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Index</li>
            <li class="active">Data Assign Permission</li>
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
                <h3 class="box-title">Data Assign Permission</h3>

                {{-- <div class="box-tools pull-right">
                    <a href="{{ route('manage-role.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                </div> --}}
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <th style="width: 20%">Role</th>
                        <th style="width: 60%">Permissions</th>
                        <th style="width: 29%">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($role as $item)
                            <tr>
                                <td style="width: 20%">{{ $item->name }}</td>
                                <td style="width: 60%">
                                    @if (isset($item->permissions))
                                        @foreach ($item->permissions as $p)
                                            <span href="#" class="badge badge-success" style="margin-top: 3px">{{ $p->name }}</span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </td style="width: 20%">
                                <td>
                                    <a href="{{ route('assign-permission.edit', [$item->id]) }}" class="btn btn-primary btn-sm">Edit</a>
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
