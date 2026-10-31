@extends('layouts.admin')

@section('content')
<h1>Pengaturan Masjid</h1>
<p>Isi hanya data yang sudah dikonfirmasi DKM. Bila ada kolom yang belum pasti, kosongkan saja — halaman depan akan menulis "belum diisi DKM" dan tidak menampilkan nomor karangan. Kosongkan rekening infaq bila belum ada nomor resmi — halaman publik akan menampilkan "belum diisi DKM".</p>
<form method="POST" action="{{ route('admin.pengaturan.update') }}">
    @csrf
    @method('PUT')
    <label>Nama Masjid</label>
    <input type="text" name="nama_masjid" value="{{ old('nama_masjid', $setting->nama_masjid) }}" required>
    <label>Alamat</label>
    <textarea name="alamat" rows="3" required>{{ old('alamat', $setting->alamat) }}</textarea>
    <label>Telepon / WhatsApp (opsional)</label>
    <input type="text" name="telepon" placeholder="Contoh: 0812-3456-7890" value="{{ old('telepon', $setting->telepon) }}">
    <label>Email (opsional)</label>
    <input type="email" name="email" placeholder="Contoh: dkm@contoh.com" value="{{ old('email', $setting->email) }}">
    <label>Rekening Infaq (opsional — kosongkan bila belum dikonfirmasi)</label>
    <input type="text" name="rekening_infaq" placeholder="Contoh: 1234567890 (kosongkan bila belum ada nomor resmi)" value="{{ old('rekening_infaq', $setting->rekening_infaq) }}">
    <label>Nama Bank (opsional)</label>
    <input type="text" name="nama_bank" placeholder="Contoh: Bank Syariah Indonesia" value="{{ old('nama_bank', $setting->nama_bank) }}">
    <button class="primary" type="submit">Simpan Pengaturan</button>
</form>
@endsection
