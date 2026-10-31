@extends('layouts.admin')

@section('content')
<h1>Detail Jadwal Khutbah</h1>
<div class="card">
<p><b>Tanggal:</b> {{ $item->tanggal->format('d F Y') }}</p>
<p><b>Khatib:</b> {{ $item->khatib }}</p>
<p><b>Tema:</b> {{ $item->tema }}</p>

<p><a href="{{ route('admin.khutbah.edit', $item) }}">Edit</a> | <a href="{{ route('admin.khutbah.index') }}">Kembali ke Daftar</a></p>
</div>
@endsection
