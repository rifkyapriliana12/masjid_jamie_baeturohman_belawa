@extends('layouts.admin')

@section('content')
<h1>Edit Slide Show</h1>
<div class="card">
<form method="POST" action="{{ route('admin.slides.update', $item) }}" enctype="multipart/form-data">
@csrf
@method('PUT')
@include('admin.slides._form')
<button class="primary" type="submit">Simpan Perubahan</button>
<a href="{{ route('admin.slides.index') }}">Batal</a>
</form>
</div>
@endsection
