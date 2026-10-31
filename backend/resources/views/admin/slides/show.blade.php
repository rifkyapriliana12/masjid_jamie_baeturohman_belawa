@extends('layouts.admin')

@section('content')
<h1>Detail Slide Show</h1>
<div class="card">
@if ($item->fotoUrl())<p><img style="max-width:400px;width:100%;border-radius:12px" src="{{ $item->fotoUrl() }}" alt=""></p>@endif
<p><b>Judul:</b> {{ $item->judul ?? 'Tanpa judul' }}</p>
<p><b>Keterangan:</b> {{ $item->keterangan ?? '-' }}</p>
<p><b>Urutan:</b> {{ $item->urutan }}</p>
<p><b>Tampil di beranda:</b> {{ $item->aktif ? 'Ya' : 'Tidak' }}</p>

<p><a href="{{ route('admin.slides.edit', $item) }}">Edit</a> | <a href="{{ route('admin.slides.index') }}">Kembali ke Daftar</a></p>
</div>
@endsection
