@extends('layouts.admin')

@section('content')
<h1>Tambah Kegiatan</h1>
<div class="card">
<form method="POST" action="{{ route('admin.kegiatan.store') }}" enctype="multipart/form-data">
@csrf
@include('admin.kegiatan._form')
<button class="primary" type="submit">Simpan</button>
<a href="{{ route('admin.kegiatan.index') }}">Batal</a>
</form>
</div>
@endsection
