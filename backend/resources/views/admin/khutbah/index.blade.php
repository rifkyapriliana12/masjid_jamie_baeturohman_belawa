@extends('layouts.admin')

@section('content')
<h1>Jadwal Khutbah</h1>
<p><a class="btn" href="{{ route('admin.khutbah.create') }}">+ Tambah Jadwal Khutbah</a></p>
<div class="card"><div class="table-wrap">
<table>
<thead><tr><th>Tanggal</th><th>Khatib</th><th>Tema</th><th>Aksi</th></tr></thead>
<tbody>
@forelse ($items as $item)
<tr>
<td>{{ $item->tanggal->format('d F Y') }}</td><td>{{ $item->khatib }}</td><td>{{ $item->tema }}</td>
<td class="aksi">
<a href="{{ route('admin.khutbah.show', $item) }}">Lihat</a> |
<a href="{{ route('admin.khutbah.edit', $item) }}">Edit</a> |
<form method="POST" action="{{ route('admin.khutbah.destroy', $item) }}" style="display:inline" onsubmit="return confirm('Hapus data ini? Foto yang terupload juga akan dihapus.')">
@csrf
@method('DELETE')
<button type="submit" style="background:none;border:0;color:#b91c1c;cursor:pointer;padding:0">Hapus</button>
</form>
</td>
</tr>
@empty
<tr><td colspan="10">Belum ada data. Klik tombol "Tambah" di atas untuk menambahkan jadwal khutbah pertama.</td></tr>
@endforelse
</tbody>
</table></div>
</div>
{{ $items->links() }}
@endsection
