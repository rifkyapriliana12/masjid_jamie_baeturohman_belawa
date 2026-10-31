<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Admin — Masjid Jami Baeturohman</title>
    <style>
        *{box-sizing:border-box} body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;color:#1c1917;background:#faf7f0;line-height:1.7;font-size:17px}
        a{color:#065f46} header{background:#064e3b;color:#fff;padding:14px 20px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px}
        header a{color:#fff;text-decoration:none;font-weight:700} nav{display:flex;flex-wrap:wrap;gap:4px;align-items:center} nav a{margin-right:6px;padding:10px 8px;min-height:44px;display:inline-flex;align-items:center;border-radius:8px} nav button{min-height:44px;padding:10px 8px}
        .wrap{max-width:1020px;margin:0 auto;padding:20px}
        .card{background:#fff;border:1px solid #e7e5e4;border-radius:16px;padding:20px;margin-bottom:16px}
        input,textarea,select{width:100%;padding:12px;border:1px solid #d6d3d1;border-radius:10px;margin:4px 0 6px;font-size:1rem}
        button.primary,.btn{background:#065f46;color:#fff;border:0;padding:13px 22px;border-radius:999px;font-weight:700;cursor:pointer;text-decoration:none;display:inline-block;font-size:1rem}
        .btn-danger{background:#b91c1c;color:#fff;border:0;padding:13px 22px;border-radius:999px;font-weight:700;cursor:pointer;font-size:1rem} .help{color:#57534e;font-size:.9rem;margin:0 0 14px} .table-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch} @media(max-width:768px){.wrap{padding:16px} .card{padding:16px}}
        @media(max-width:640px){header{flex-direction:column;align-items:flex-start} header nav{width:100%} .wrap{padding:14px} button.primary,.btn{display:block;width:100%;text-align:center} img.thumb{width:88px;height:58px} td,th{padding:10px 8px}}
        table{width:100%;border-collapse:collapse;min-width:560px} th,td{border-bottom:1px solid #e7e5e4;padding:8px;text-align:left;vertical-align:top}
        .alert{background:#dcfce7;border:1px solid #bbf7d0;padding:12px;border-radius:12px;margin-bottom:16px}
        .errors{background:#fee2e2;border:1px solid #fecaca;padding:12px;border-radius:12px;margin-bottom:16px}
        .muted{color:#57534e;font-size:.9rem} img{max-width:100%;height:auto} img.thumb{width:120px;height:80px;object-fit:cover;border-radius:8px} .aksi a,.aksi button{display:inline-block;padding:8px 4px;min-height:36px}
    </style>
</head>
<body>
<header>
    <a href="{{ route('admin.dashboard') }}">Panel Admin — Masjid Jami Baeturohman</a>
    <nav>
        <a href="{{ route('admin.kegiatan.index') }}">Kegiatan</a>
        <a href="{{ route('admin.slides.index') }}">Slide Show</a>
        <a href="{{ route('admin.khutbah.index') }}">Khutbah</a>
        <a href="{{ route('admin.pengurus.index') }}">Struktur DKM</a>
        <a href="{{ route('admin.pengaturan.edit') }}">Pengaturan</a>
        <a href="{{ route('home') }}">Lihat Website</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit" style="background:transparent;border:0;color:#fff;font-weight:700;cursor:pointer">Logout ({{ auth()->user()->email }})</button>
        </form>
    </nav>
</header>
<div class="wrap">
    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="errors"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif
    @yield('content')
</div>
</body>
</html>
