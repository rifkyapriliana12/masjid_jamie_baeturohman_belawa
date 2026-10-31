@extends('layouts.admin')

@section('content')
<h1>Slide Show</h1>
<p>Foto-foto di sini tampil bergantian di bagian atas beranda website. Upload foto masjid asli, atur urutannya, dan sembunyikan slide yang belum ingin ditampilkan.</p>
<p><a class="btn" href="{{ route('admin.slides.create') }}">+ Tambah Slide Show</a></p>
<div class="card"><div class="table-wrap">
<table>
<thead><tr><th>Foto</th><th>Judul</th><th>Urutan</th><th>Tampil?</th><th>Aksi</th></tr></thead>
<tbody>
@forelse ($items as $item)
<tr>
@if ($item->fotoUrl())<td><img class="thumb" src="{{ $item->fotoUrl() }}" alt=""></td>@else<td>-</td>@endif<td>{{ $item->judul ?? 'Tanpa judul' }}</td><td>{{ $item->urutan }}</td><td>{{ $item->aktif ? 'Ya' : 'Tidak' }}</td>
<td class="aksi">
<a href="{{ route('admin.slides.show', $item) }}">Lihat</a> |
<a href="{{ route('admin.slides.edit', $item) }}">Edit</a> |
<form method="POST" action="{{ route('admin.slides.destroy', $item) }}" style="display:inline" onsubmit="return confirm('Hapus slide ini? Foto yang terupload juga akan dihapus.')">
@csrf
@method('DELETE')
<button type="submit" style="background:none;border:0;color:#b91c1c;cursor:pointer;padding:0">Hapus</button>
</form>
</td>
</tr>
@empty
<tr><td colspan="10">Belum ada slide show. Klik tombol "Tambah Slide Show" di atas, lalu upload foto masjid asli. Selama belum ada slide, beranda tetap menampilkan teks seperti sekarang.</td></tr>
@endforelse
</tbody>
</table></div>
</div>
{{ $items->links() }}
@endsection
