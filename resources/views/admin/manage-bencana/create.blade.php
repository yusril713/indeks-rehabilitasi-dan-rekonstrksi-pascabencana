@section('style')
    <style>
        .thumb-image{
            /* float:center; */
            width:100px;
            position:relative;
            padding:5px;
        }
    </style>
@endsection
@extends('layouts.admin')
@section('title')
    Tambah Bencana
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Bencana
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('manage-bencana.index') }}"> Bencana</a></li>
            <li class="active">Tambah</li>
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
                <h3 class="box-title">Tambah Bencana</h3>

                {{-- <div class="box-tools pull-right">
                    <a href="{{ route('manage-bencana.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
                </div> --}}
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-5 col-md-offset-3">
                        <form id="ff" action="{{ route('manage-bencana.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data"  onsubmit="return confirm('Yakin ingin menyimpan data tersebut?')">
                            @csrf
                            <div class="box-body">

                                {{-- @livewire('admin.country') --}}

                                <div class="form-group">
                                    <label for="provinsi" class="col-sm-4 control-label">Provinsi</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2 @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi">
                                            <option value="" selected>Pilih Provinsi</option>
                                            @foreach($provinsi as $prov)
                                                <option value="{{ $prov->id }}" {{ (old('provinsi') == ($prov->id)) ? 'selected' : '' }}>{{ $prov->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('provinsi')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kabupaten" class="col-sm-4 control-label">Kabupaten/ Kota</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2 @error('kabupaten') is-invalid @enderror" id="kabupaten" name="kabupaten">
                                            <option value="" selected>Pilih Kabupaten</option>
                                        </select>
                                        @error('kabupaten')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label for="kecamatan" class="col-sm-4 control-label">Kecamatan</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2 @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan">
                                            <option value="" selected>Pilih Kecamatan</option>
                                        </select>
                                        @error('kecamatan')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label for="kelurahan" class="col-sm-4 control-label">Desa/ Kelurahan</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2 @error('kelurahan') is-invalid @enderror" id="kelurahan" name="kelurahan">
                                            <option selected>Pilih Desa</option>
                                        </select>
                                        @error('kelurahan')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="alamat" class="col-sm-4 control-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" cols="30" rows="3">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Jenis Bencana</label>
                                    <div class="col-sm-8">
                                        <input class="form-control @error('jenis_bencana') is-invalid @enderror" type="text" name="jenis_bencana" id="jenis_bencana" value="{{ old('jenis_bencana') }}">
                                        @error('jenis_bencana')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Foto Bencana</label>
                                    <div class="col-sm-8">
                                        <input class="form-control @error('images.*') is-invalid @enderror" type="file" name="images[]" id="images" multiple onchange="previewImages()" value="{{ old('images.*') }}">
                                        @error('images.*')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <div id="foto_view"></div>
                                    </div>
                                </div>

                                {{-- <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Foto Bencana</label>
                                    <div class="col-sm-8">
                                        <div class="input-images-1" style="padding-top: .5rem;"></div>
                                    </div>
                                </div> --}}

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Tanggal Bencana</label>
                                    <div class="col-sm-8">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="tgl_bencana" id="tgl_bencana" class="form-control datepicker @error('tgl_bencana') is-invalid @enderror" value="{{ old('tgl_bencana') }}">
                                            @error('tgl_bencana')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Jam Bencana</label>
                                    <div class="col-sm-8">
                                        <div class="input-group bootstrap-timepicker">
                                            <input type="text" name="jam_bencana" id="jam_bencana" class="form-control timepicker @error('jam_bencana') is-invalid @enderror" value="{{ old('jam_bencana') }}">
                                            @error('jam_bencana')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-8 col-md-offset-4">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success btn-sm bt_save"><i class="fa fa-save"></i> Simpan</button>
                                </div>

                                <div class="pull-left">
                                    <a href="{{ route('manage-bencana.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>&nbsp; Kembali</a>
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
    // function previewImages() {

    //     var preview = document.querySelector('#images');

    //     if (this.files) {
    //         [].forEach.call(this.files, readAndPreview);
    //     }

    //     function readAndPreview(file) {

    //         // Make sure `file.name` matches our extensions criteria
    //         if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
    //             return alert(file.name + " is not an image");
    //         } // else...
            
    //         var reader = new FileReader();
            
    //         reader.addEventListener("load", function() {
    //             var image = new Image();
    //             image.height = 100;
    //             image.title  = file.name;
    //             image.src    = this.result;
    //             preview.appendChild(image);
    //         });
            
    //         reader.readAsDataURL(file);
            
    //         }

    //     }

    //     document.querySelector('#images').addEventListener("change", previewImages);
        

        $("#images").on('change', function() {
            //Get count of selected files
            var countFiles = $(this)[0].files.length;
            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            var image_holder = $("#foto_view");
            image_holder.empty();
            if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                if (typeof(FileReader) != "undefined") {
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) 
                {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                    $("<img />", {
                        "src": e.target.result,
                        "class": "thumb-image",
                        "width": "100",
                        "height": "auto"
                    }).appendTo(image_holder);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
                } else {
                alert("This browser does not support FileReader.");
                }
            } else {
                alert("Pls select only images");
            }
        });

    // $('.input-images-1').imageUploader();
        
    // let $inputImages = $form.find('input[name^="images"]');
    // if (!$inputImages.length) {
    //     $inputImages = $form.find('input[name^="photos"]')
    // }
</script>

<script>
    
    $(document).ready(function() {
        
        $('#provinsi').change(function() {
            var prov = $(this).val();
            //console.log(prov);

            url = "{{ url('get-kab') }}" + "/" + prov;
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#kabupaten').empty();
                    $('#kabupaten').append('<option value="" selected>Pilih Kabupaten</option>');
                    $.each(data, function(key, value) {
                        $('#kabupaten').append('<option value="'+ value.id +'" {{ (old('kabupaten') == ('+ value.id +')) ? 'selected' : '' }}>'+ value.nama +'</option>');
                    });
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        });

        $('#kabupaten').change(function() {
            var kab = $(this).val();
            //console.log(kab);

            url = "{{ url('get-kec') }}" + "/" + kab;
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#kecamatan').empty();
                    $('#kecamatan').append('<option value="" selected>Pilih Kecamatan</option>');
                    $.each(data, function(key, value) {
                        $('#kecamatan').append('<option value="'+ value.id +'" {{ (old('kecamatan') == ('+ value.id +')) ? 'selected' : '' }}>'+ value.nama +'</option>');
                    });
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        });

        $('#kecamatan').change(function() {
            var kec = $(this).val();
            //console.log(kec);

            url = "{{ url('get-kel') }}" + "/" + kec;
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#kelurahan').empty();
                    $('#kelurahan').append('<option value="" selected>Pilih Desa</option>');
                    $.each(data, function(key, value) {
                        $('#kelurahan').append('<option value="'+ value.id +'" {{ (old('kelurahan') == ('+ value.id +')) ? 'selected' : '' }}>'+ value.nama +'</option>');
                    });
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        });

        $('.bt_save').click(function() {
            $('.alert-danger').fadeIn();
        });



        //$('.alert-danger').fadeOut(5000);
        setTimeout(function(){ $('.alert-danger').fadeOut(); }, 5000);

        $('.bt_clear').on('click', function() {
            $('#ff')[0].reset();
            $('.select2').select2().reset();
        });
    });
</script>
@endsection
