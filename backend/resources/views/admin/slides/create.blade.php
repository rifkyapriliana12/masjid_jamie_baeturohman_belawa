@extends('layouts.admin')

@section('content')
<h1>Tambah Slide Show</h1>
<div class="card">
<form method="POST" action="{{ route('admin.slides.store') }}" enctype="multipart/form-data">
@csrf
@include('admin.slides._form')
<button class="primary" type="submit">Simpan</button>
<a href="{{ route('admin.slides.index') }}">Batal</a>
</form>
</div>
@endsection
