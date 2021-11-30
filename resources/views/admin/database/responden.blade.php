@extends('layouts.admin')
@section('title')
    Form Data Responden
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Form Data Responden
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Index</li>
            <li class="active">Form Data Responden</li>
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
                <h3 class="box-title">Form Data Responden</h3>
                <hr>

                <div class="box-body table-responsive" id="table_data">
                    @include('admin.database.responden-child')
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $(document).on('click', '.page-link', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            console.log(page)
            fetchData(page);
        });
        function fetchData(page) {
            const SEKTOR = ["Pemukiman", "INFRASTRUKTUR", "SOSIAL", "EKONOMI", "LINTAS SEKTOR"]
            var url = "{{ url('database/responden/child') }}" ;
            $.ajax({
                method: 'GET',
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    page: page
                },
                success: function(data) {
                    $('#table_data').html(data)
                }
            })
        }

    });
</script>
@endsection
