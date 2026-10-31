@extends('layouts.admin')

@section('content')
<h1>Tambah Jadwal Khutbah</h1>
<div class="card">
<form method="POST" action="{{ route('admin.khutbah.store') }}" enctype="multipart/form-data">
@csrf
@include('admin.khutbah._form')
<button class="primary" type="submit">Simpan</button>
<a href="{{ route('admin.khutbah.index') }}">Batal</a>
</form>
</div>
@endsection
