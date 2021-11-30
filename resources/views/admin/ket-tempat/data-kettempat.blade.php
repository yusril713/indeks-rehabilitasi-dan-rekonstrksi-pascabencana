@php $i=1; @endphp
@foreach ($data as $item)
<tr>
    <td style="width: 10px">{{ $i++ }}.</td>
    <td>{{ $item->prov->nama }}</td>
    <td>{{ $item->kab->nama }}</td>
    <td>{{ $item->kec->nama }}</td>
    <td>{{ $item->kel->nama }}</td>
    <td>{{ $item->alamat }}</td>
    <td>{{ $item->tahun_bencana }}</td>
    <td>{{ $item->jenis_bencana }}</td>
    <td>
        @role('Super Admin|Level 3')
            @if ($item->status == 'success')
                {{ "FINISH" }}
            @else
                <a href="{{ route('manage-responden', [Crypt::encrypt($item->id)]) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Pending</a>
            @endif
        @else
            @if(Auth::user()->id == isset($item->user_id))
                @if ($item->status == 'success')
                    {{ "FINISH" }}
                @else
                    <a href="{{ route('manage-responden', [Crypt::encrypt($item->id)]) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Pending</a>
                @endif
            @else
                @if ($item->status == 'success')
                    {{ "FINISH" }}
                @else
                    {{ "PENDING" }}
            @endif
        @endif
        @endrole
    </td>
    <td>
        @can('manage-responden')
        <a href="{{ route('manage-responden', [Crypt::encrypt($item->id)]) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
        @endcan
    </td>
    <td>
        @can('keterangan-tempat.destroy')
        <form action="{{ route('keterangan-tempat.destroy', [Crypt::encrypt($item->id)]) }}" method="post" onsubmit="return confirm('Are you sure want to remove this data?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
        </form>
        @endcan
    </td>
</tr>
@endforeach
