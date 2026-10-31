@extends('layouts.admin')

@section('content')
<h1>Dasbor Admin</h1>
<p>Selamat datang, {{ auth()->user()->name }}. Di sini Anda bisa mengubah isi website masjid tanpa perlu mengerti pemrograman. Pilih salah satu tombol di bawah ini.</p>
<h2>Apa yang ingin Anda lakukan?</h2>
<p><a class="btn" href="{{ route('admin.kegiatan.create') }}">+ Tambah Kegiatan</a> <a class="btn" href="{{ route('admin.slides.create') }}">+ Tambah Slide Show</a> <a class="btn" href="{{ route('admin.khutbah.create') }}">+ Tambah Jadwal Khutbah</a> <a class="btn" href="{{ route('admin.pengurus.create') }}">+ Tambah Pengurus</a></p>
<p class="help">Contoh pemakaian: untuk mengumumkan pengajian baru, klik "Tambah Kegiatan", isi judul dan tanggalnya, lalu klik "Simpan". Kegiatan itu langsung tampil di halaman depan website.</p>
<div class="card">
    <p><b>Kegiatan:</b> {{ \App\Models\Kegiatan::count() }} data — <a href="{{ route('admin.kegiatan.index') }}">Kelola Kegiatan</a></p>
    <p><b>Slide Show:</b> {{ \App\Models\Slide::count() }} data — <a href="{{ route('admin.slides.index') }}">Kelola Slide Show</a></p>
    <p><b>Jadwal Khutbah:</b> {{ \App\Models\Khutbah::count() }} data — <a href="{{ route('admin.khutbah.index') }}">Kelola Khutbah</a></p>
    <p><b>Struktur DKM:</b> {{ \App\Models\Pengurus::count() }} data — <a href="{{ route('admin.pengurus.index') }}">Kelola Pengurus</a></p>
    <p><b>Pengaturan masjid:</b> <a href="{{ route('admin.pengaturan.edit') }}">Ubah nama, alamat, telepon, email, dan rekening infaq</a></p>
</div>
<p class="muted">Penting: data contoh dari seeder (nama "Belum diisi" dan tema contoh) harus diganti dengan data asli sebelum website diumumkan ke jamaah.</p>
@endsection
