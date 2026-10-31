<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $setting->nama_masjid ?? config('mosque.name') }} — Desa Belawa</title>
    <style>
        *{box-sizing:border-box} body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;color:#1c1917;background:#faf7f0;line-height:1.7;font-size:17px}
        a{color:#065f46} header{background:#064e3b;color:#fff;padding:14px 20px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px}
        header a{color:#fff;text-decoration:none;font-weight:700} nav{display:flex;flex-wrap:wrap;gap:4px;align-items:center} nav a{margin-right:6px;padding:10px 8px;min-height:44px;display:inline-flex;align-items:center;border-radius:8px}
        .wrap{max-width:1020px;margin:0 auto;padding:0 20px}
        .hero{background:#064e3b;color:#fff;text-align:center;padding:56px 20px}
        .hero-slider{position:relative;overflow:hidden;padding:0;min-height:460px;display:flex;align-items:center;justify-content:center}
        .hero-slider .slides{position:absolute;inset:0;margin:0}
        .hero-slider .slide{display:none;position:absolute;inset:0;margin:0}
        .hero-slider .slide.active{display:block}
        .hero-slider .slide img{width:100%;height:100%;object-fit:cover;object-position:center}
        .hero-overlay{position:absolute;inset:0;background:linear-gradient(rgba(6,78,59,.78),rgba(6,78,59,.55))}
        .hero-text{position:relative;z-index:2;padding:56px 20px;text-shadow:0 2px 12px rgba(0,0,0,.45)}
        .slide-caption{position:absolute;left:0;right:0;bottom:0;z-index:2;background:linear-gradient(transparent,rgba(0,0,0,.65));color:#fff;text-align:center;padding:48px 20px 20px}
        .slide-caption b{display:block;font-size:1.2rem}
        .slide-caption span{display:block;max-width:640px;margin:4px auto 0}
        .slide-nav{position:absolute;top:50%;transform:translateY(-50%);z-index:3;width:48px;height:48px;border-radius:50%;border:0;background:#fbbf24;color:#064e3b;font-size:1.4rem;font-weight:800;cursor:pointer}
        .slide-prev{left:14px} .slide-next{right:14px}
        .slide-dots{position:absolute;left:0;right:0;bottom:14px;z-index:3;display:flex;gap:8px;justify-content:center}
        .slide-dot{width:14px;height:14px;border-radius:50%;border:2px solid #fff;background:rgba(255,255,255,.4);cursor:pointer;padding:0}
        .slide-dot.active{background:#fbbf24}
        .foto-kosong{background:#e7e5e4;color:#57534e;border-radius:12px;padding:28px 12px;text-align:center;font-size:.9rem;margin-bottom:12px}
        img.pengurus-foto{width:100%;height:auto;aspect-ratio:3/4;object-fit:cover;object-position:top center;border-radius:12px}
        .hero h1{margin:10px 0;font-size:clamp(1.9rem,6vw,2.4rem);overflow-wrap:anywhere} .gold{color:#fbbf24;letter-spacing:.2em;font-weight:700}
        .btn{display:inline-block;background:#fbbf24;color:#064e3b;padding:14px 26px;border-radius:999px;text-decoration:none;font-weight:800;margin:6px;font-size:1.05rem}
        .btn2{display:inline-block;border:2px solid #fff;color:#fff;padding:14px 26px;border-radius:999px;text-decoration:none;font-weight:700;margin:6px;font-size:1.05rem}
        section{padding:44px 0} .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px}
        .card{background:#fff;border:1px solid #e7e5e4;border-radius:16px;padding:20px}
        .dark{background:#064e3b;color:#fff;border-radius:20px;padding:24px}
        .dark h3{margin-top:0} .prayer{display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:12px;margin-top:16px}
        .prayer div{background:rgba(255,255,255,.12);border-radius:14px;padding:14px;text-align:center}
        .prayer b{font-size:1.3rem} .notice{background:#fef3c7;border:1px solid #fde68a;border-radius:14px;padding:16px}
        .muted{color:#57534e;font-size:.9rem} img{max-width:100%} img.resp{width:100%;height:auto;aspect-ratio:16/9;object-fit:cover;border-radius:12px} img.resp-detail{width:100%;height:auto;max-height:420px;object-fit:cover;border-radius:12px}
        footer{background:#064e3b;color:#d1fae5;text-align:center;padding:24px} .alert{background:#dcfce7;border:1px solid #bbf7d0;padding:12px;border-radius:12px}
        .errors{background:#fee2e2;border:1px solid #fecaca;padding:12px;border-radius:12px}
        input,textarea,select{width:100%;padding:10px;border:1px solid #d6d3d1;border-radius:10px;margin:4px 0 12px}
        button.primary{background:#065f46;color:#fff;border:0;padding:10px 18px;border-radius:999px;font-weight:700;cursor:pointer}
        .table-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch} table{width:100%;border-collapse:collapse;min-width:640px} th,td{border-bottom:1px solid #e7e5e4;padding:8px;text-align:left;vertical-align:top}
        @media(max-width:768px){.wrap{padding:0 16px} section{padding:32px 0} .hero{padding:44px 16px} .hero-slider{min-height:420px} .hero-text{padding:44px 16px} .grid{grid-template-columns:repeat(2,minmax(0,1fr))} .prayer{grid-template-columns:repeat(2,minmax(0,1fr))}}
        @media(max-width:640px){header{flex-direction:column;align-items:flex-start} header nav{width:100%} .wrap{padding:0 14px} section{padding:28px 0} .hero{padding:36px 14px} .hero-slider{min-height:400px} .hero-text{padding:36px 14px} .slide-nav{width:44px;height:44px} .slide-prev{left:8px} .slide-next{right:8px} .grid{grid-template-columns:1fr} .prayer{grid-template-columns:repeat(2,minmax(0,1fr))} .prayer b{font-size:1.5rem} .btn,.btn2{display:block;width:100%;text-align:center} .dark{padding:18px} .card{padding:16px}}
    </style>
</head>
<body>
<header>
    <a href="{{ route('home') }}">🕌 {{ $setting->nama_masjid ?? config('mosque.name') }} <small>— DESA BELAWA</small></a>
    <nav>
        <a href="{{ route('home') }}#beranda">Beranda</a>
        <a href="{{ route('home') }}#tentang">Tentang</a>
        <a href="{{ route('home') }}#jadwal">Jadwal Sholat</a>
        <a href="{{ route('home') }}#kegiatan">Kegiatan</a>
        <a href="{{ route('home') }}#khutbah">Khutbah</a>
        <a href="{{ route('home') }}#struktur">Struktur DKM</a>
        <a href="{{ route('home') }}#infaq">Infaq</a>
        <a href="{{ route('home') }}#kontak">Kontak</a>
        @auth
            <a href="{{ route('admin.dashboard') }}">Panel Admin</a>
        @else
            <a href="{{ route('login') }}">Login Admin</a>
        @endauth
    </nav>
</header>
<main>
    @if (session('success'))
        <div class="wrap" style="padding-top:20px"><div class="alert">{{ session('success') }}</div></div>
    @endif
    @yield('content')
</main>
<footer>
    <p><b>{{ $setting->nama_masjid ?? config('mosque.name') }} — Desa Belawa</b></p>
    <p>Dikelola oleh Dewan Kemakmuran Masjid (DKM)</p>
</footer>
</body>
</html>
