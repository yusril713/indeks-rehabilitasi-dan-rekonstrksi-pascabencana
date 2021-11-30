<table id="tb_responden" class="table table-bordered table-striped table-hover">
    <thead>
        <th>No</th>
        <th>Provinsi</th>
        <th>Kabupaten</th>
        <th>Kecamatan</th>
        <th>Kelurahan</th>
        <th>Keterangan</th>
    </thead>
    <tbody>
        @php
            $no =  ($data->currentpage()-1)* $data->perpage() + 1;
        @endphp
        @foreach ($data as $item)
            <tr>
                <td>{{ $no++ }}.</td>
                <td>{{ $item->prov->nama }}</td>
                <td>{{ $item->kab->nama }}</td>
                <td>{{ $item->kec->nama }}</td>
                <td>{{ $item->kel->nama }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $data->links() }}
