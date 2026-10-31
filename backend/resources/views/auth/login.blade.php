@extends('layouts.app')

@section('content')
<div class="wrap">
    <section style="max-width:520px;margin:0 auto">
        <h1>Login Admin</h1>
        <p>Halaman ini hanya untuk pengurus DKM yang mengelola website masjid.</p>
        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            <label><input type="checkbox" name="remember" value="1" style="width:auto"> Ingat saya</label>
            <div><button class="primary" type="submit">Masuk</button></div>
        </form>
        <p class="muted">Akun demo hasil seeder ada di README (bukan akun asli). Ganti passwordnya setelah login pertama.</p>
    </section>
</div>
@endsection
