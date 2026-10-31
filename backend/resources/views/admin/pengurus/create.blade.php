@extends('layouts.admin')

@section('content')
<h1>Tambah Pengurus DKM</h1>
<div class="card">
<form method="POST" action="{{ route('admin.pengurus.store') }}" enctype="multipart/form-data">
@csrf
@include('admin.pengurus._form')
<button class="primary" type="submit">Simpan</button>
<a href="{{ route('admin.pengurus.index') }}">Batal</a>
</form>
</div>
@endsection
