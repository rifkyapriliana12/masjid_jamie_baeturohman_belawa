@extends('layouts.admin')

@section('content')
<h1>Kegiatan</h1>
<p><a class="btn" href="{{ route('admin.kegiatan.create') }}">+ Tambah Kegiatan</a></p>
<div class="card"><div class="table-wrap">
<table>
<thead><tr><th>Foto</th><th>Judul</th><th>Tanggal</th><th>Aksi</th></tr></thead>
<tbody>
@forelse ($items as $item)
<tr>
@if ($item->fotoUrl())<td><img class="thumb" src="{{ $item->fotoUrl() }}" alt=""></td>@else<td>-</td>@endif<td>{{ $item->judul }}</td><td>{{ $item->tanggal->format('d F Y') }}</td>
<td class="aksi">
<a href="{{ route('admin.kegiatan.show', $item) }}">Lihat</a> |
<a href="{{ route('admin.kegiatan.edit', $item) }}">Edit</a> |
<form method="POST" action="{{ route('admin.kegiatan.destroy', $item) }}" style="display:inline" onsubmit="return confirm('Hapus data ini? Foto yang terupload juga akan dihapus.')">
@csrf
@method('DELETE')
<button type="submit" style="background:none;border:0;color:#b91c1c;cursor:pointer;padding:0">Hapus</button>
</form>
</td>
</tr>
@empty
<tr><td colspan="10">Belum ada data. Klik tombol "Tambah" di atas untuk menambahkan kegiatan pertama.</td></tr>
@endforelse
</tbody>
</table></div>
</div>
{{ $items->links() }}
@endsection
