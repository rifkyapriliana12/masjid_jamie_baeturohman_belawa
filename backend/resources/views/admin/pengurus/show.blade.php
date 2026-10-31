@extends('layouts.admin')

@section('content')
<h1>Detail Pengurus DKM</h1>
<div class="card">
@if ($item->fotoUrl())<p><img style="max-width:400px;width:100%;border-radius:12px" src="{{ $item->fotoUrl() }}" alt=""></p>@endif
<p><b>Nama:</b> {{ $item->nama }}</p>
<p><b>Jabatan:</b> {{ $item->jabatan }}</p>
<p><b>Urutan:</b> {{ $item->urutan }}</p>

<p><a href="{{ route('admin.pengurus.edit', $item) }}">Edit</a> | <a href="{{ route('admin.pengurus.index') }}">Kembali ke Daftar</a></p>
</div>
@endsection
