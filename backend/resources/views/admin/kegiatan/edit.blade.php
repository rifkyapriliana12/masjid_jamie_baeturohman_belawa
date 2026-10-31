@extends('layouts.admin')

@section('content')
<h1>Edit Kegiatan</h1>
<div class="card">
<form method="POST" action="{{ route('admin.kegiatan.update', $item) }}" enctype="multipart/form-data">
@csrf
@method('PUT')
@include('admin.kegiatan._form')
<button class="primary" type="submit">Simpan Perubahan</button>
<a href="{{ route('admin.kegiatan.index') }}">Batal</a>
</form>
</div>
@endsection
