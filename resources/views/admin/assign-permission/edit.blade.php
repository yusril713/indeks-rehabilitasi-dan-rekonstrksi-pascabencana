@extends('layouts.admin')
@section('title')
    Edit Assign Permission
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Assign Permission
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('manage-role.index') }}"> Assign Permission</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>


    <section class="content">
        @if (session('status'))
            <script>
                Swal.fire(
                    'Messages',
                    'You clicked the button!',
                    'success'
                );
            </script>
        @endif
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Assign Permission</h3>

                {{-- <div class="box-tools pull-right">
                    <a href="{{ route('manage-bencana.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
                </div> --}}
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="ff" action="{{ route('assign-permission.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data"  onsubmit="return confirm('Yakin ingin menyimpan data tersebut?')">
                            @csrf
                            <div class="box-body">
                                <input type="hidden" name="role_id" value="{{$role_has_pemissions->id}}">

                                <div class="form-group">
                                    <label for="nama" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="role" id="role" value="{{ $role_has_pemissions->name }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nama" class="col-sm-2 control-label">Guard Name</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="permissions[]" id="choices-multiple-remove-button" multiple>
                                            @foreach ($permission as $item)
                                                <option value="{{ $item->name }}"
                                                    @if (isset($role_has_pemissions->permissions))
                                                        @foreach ($role_has_pemissions->permissions as $rhp)
                                                            @if ($rhp->name == $item->name)
                                                                {{ 'selected' }}
                                                                @php
                                                                    break;
                                                                @endphp
                                                            @else
                                                                {{ '' }}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    >{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-8 col-md-offset-4">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success btn-sm bt_save"><i class="fa fa-save"></i> Simpan</button>
                                </div>

                                <div class="pull-left">
                                    <a href="{{ route('manage-role.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </section>
</div>
@endsection
@section('script')
    <script>
         $(document).ready(function(){
            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
            });
        });
    </script>
@endsection
