@extends('layouts.admin')
@section('title')
    Data Permission
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Permission
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Index</li>
            <li class="active">Data Permission</li>
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
                <h3 class="box-title">Data Permission</h3>

                {{-- <div class="box-tools pull-right">
                    <a href="{{ route('manage-role.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                </div> --}}
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <th>No</th>
                        <th>Route Name</th>
                        <th>Method</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @for ($i = 34; $i < sizeof($routes); $i++)
                            @php
                                $cek = false;
                                foreach ($permission as $item) {
                                    if(isset($routes[$i]->action['as'])) {
                                        if($item->name == $routes[$i]->action['as']) {
                                            $cek = true;
                                            break;
                                        } else {
                                            $cek = false;
                                        }
                                    } else {
                                        break;
                                    }
                                }
                            @endphp
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ isset($routes[$i]->action['as']) ? $routes[$i]->action['as'] : '-' }}</td>
                                <td>{{ isset($routes[$i]->methods) ? implode(', ', $routes[$i]->methods) : '-' }}</td>
                                <td>
                                    @if ($cek)
                                        <form action="{{ route('manage-permission.destroy', [isset($routes[$i]->action['as']) ? $routes[$i]->action['as'] : '-']) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                        </form>
                                    @else
                                        <form action="{{ route('manage-permission.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="name" value="{{ isset($routes[$i]->action['as']) ? $routes[$i]->action['as'] : '-' }}">
                                            <button type="submit" class="btn btn-primary btn-sm">Add</button>
                                        </form>
                                    @endif

                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

        </div>

    </section>
</div>
@endsection
