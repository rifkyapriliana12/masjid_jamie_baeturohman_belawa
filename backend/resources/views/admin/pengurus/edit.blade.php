@extends('layouts.admin')

@section('content')
<h1>Edit Pengurus DKM</h1>
<div class="card">
<form method="POST" action="{{ route('admin.pengurus.update', $item) }}" enctype="multipart/form-data">
@csrf
@method('PUT')
@include('admin.pengurus._form')
<button class="primary" type="submit">Simpan Perubahan</button>
<a href="{{ route('admin.pengurus.index') }}">Batal</a>
</form>
</div>
@endsection
