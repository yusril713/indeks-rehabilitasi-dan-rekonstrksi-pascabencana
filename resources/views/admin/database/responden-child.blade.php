<table id="tb_responden" class="table table-bordered table-striped table-hover">
    <thead>
        <th>No</th>
        <th>No Responden</th>
        <th>Responden</th>
        <th>Provinsi</th>
        <th>Kabupaten</th>
        <th>Kecamatan</th>
        <th>Kelurahan</th>
        <th>Keterangan</th>
    </thead>
    <tbody>
        @php
            $no = ($data->currentpage()-1)* $data->perpage() + 1;
        @endphp
        @foreach ($data as $item)
            <tr>
                <td>{{ $no++ }}.</td>
                <td>{{ $item->petugas_responden->no_responden }}</td>
                <td>{{ $item->petugas_responden->nama_responden }}</td>
                <td>{{ $item->prov->nama }}</td>
                <td>{{ $item->kab->nama }}</td>
                <td>{{ $item->kec->nama }}</td>
                <td>{{ $item->kel->nama }}</td>
                <td><a class="btn btn-primary btn-sm" href="{{ url('database/kuesioner-responden/' . $item->petugas_responden->id) }}">Lihat Kuesioner</a>
                <a class="btn btn-success btn-sm" href="{{ url('database/detail-responden/' . $item->id) }}">Lihat Data</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $data->onEachSide(5)->links() }}
