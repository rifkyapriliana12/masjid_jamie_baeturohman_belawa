@extends('layouts.admin')

@section('content')
<h1>Detail Kegiatan</h1>
<div class="card">
@if ($item->fotoUrl())<p><img style="max-width:400px;width:100%;border-radius:12px" src="{{ $item->fotoUrl() }}" alt=""></p>@endif
<p><b>Judul:</b> {{ $item->judul }}</p>
<p><b>Tanggal:</b> {{ $item->tanggal->format('d F Y') }}</p>
<p>{{ $item->deskripsi }}</p>

<p><a href="{{ route('admin.kegiatan.edit', $item) }}">Edit</a> | <a href="{{ route('admin.kegiatan.index') }}">Kembali ke Daftar</a></p>
</div>
@endsection
