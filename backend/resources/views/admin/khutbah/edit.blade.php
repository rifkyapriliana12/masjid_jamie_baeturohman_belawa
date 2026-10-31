@extends('layouts.admin')

@section('content')
<h1>Edit Jadwal Khutbah</h1>
<div class="card">
<form method="POST" action="{{ route('admin.khutbah.update', $item) }}" enctype="multipart/form-data">
@csrf
@method('PUT')
@include('admin.khutbah._form')
<button class="primary" type="submit">Simpan Perubahan</button>
<a href="{{ route('admin.khutbah.index') }}">Batal</a>
</form>
</div>
@endsection
