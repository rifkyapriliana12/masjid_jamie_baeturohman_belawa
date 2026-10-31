@extends('layouts.app')

@section('content')
<div class="wrap">
    <section>
        <p><a href="{{ route('home') }}#kegiatan">&larr; Kembali ke Beranda</a></p>
        <p class="muted">{{ $kegiatan->tanggal->format('d F Y') }}</p>
        <h1>{{ $kegiatan->judul }}</h1>
        @if ($kegiatan->fotoUrl())
            <img class="resp-detail" src="{{ $kegiatan->fotoUrl() }}" alt="{{ $kegiatan->judul }}">
        @endif
        <p style="margin-top:16px">{{ $kegiatan->deskripsi }}</p>
        <h2>Kegiatan Lainnya</h2>
        <div class="grid">
            @foreach ($lainnya as $lain)
                <div class="card">
                    <p class="muted">{{ $lain->tanggal->format('d F Y') }}</p>
                    <h3><a href="{{ route('kegiatan.show', $lain) }}">{{ $lain->judul }}</a></h3>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
