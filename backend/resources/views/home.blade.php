@extends('layouts.app')

@section('content')
@if ($slides->isNotEmpty())
<section class="hero hero-slider" id="beranda">
    <div class="slides" id="slideshow" data-count="{{ $slides->count() }}">
        @foreach ($slides as $slide)
            <figure class="slide {{ $loop->first ? 'active' : '' }}">
                <img src="{{ $slide->fotoUrl() }}" alt="{{ $slide->judul ?? 'Foto Masjid Jami Baeturohman' }}">
                @if ($slide->judul || $slide->keterangan)
                    <figcaption class="slide-caption">
                        @if ($slide->judul)<b>{{ $slide->judul }}</b>@endif
                        @if ($slide->keterangan)<span>{{ $slide->keterangan }}</span>@endif
                    </figcaption>
                @endif
            </figure>
        @endforeach
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-text">
        <p style="font-size:1.6rem;color:#fbbf24">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
        <p>Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang</p>
        <h1>{{ $setting->nama_masjid }}</h1>
        <p class="gold">DESA BELAWA</p>
        <p style="max-width:640px;margin:0 auto">{{ config('mosque.tagline') }} — rumah ibadah dan pembinaan umat bagi warga Desa Belawa dan sekitarnya.</p>
        <p style="margin-top:20px">
            <a class="btn" href="#jadwal">Lihat Jadwal Sholat</a>
            <a class="btn2" href="#kegiatan">Kegiatan Masjid</a>
        </p>
    </div>
    @if ($slides->count() > 1)
        <button class="slide-nav slide-prev" type="button" aria-label="Slide sebelumnya">&#10094;</button>
        <button class="slide-nav slide-next" type="button" aria-label="Slide berikutnya">&#10095;</button>
        <div class="slide-dots">
            @foreach ($slides as $slide)
                <button class="slide-dot {{ $loop->first ? 'active' : '' }}" type="button" aria-label="Ke slide {{ $loop->iteration }}"></button>
            @endforeach
        </div>
    @endif
</section>
<script>
(function () {
    var box = document.getElementById('slideshow');
    if (!box) return;
    var items = box.querySelectorAll('.slide');
    if (items.length <= 1) return;
    var section = box.closest('.hero-slider');
    var dots = section.querySelectorAll('.slide-dot');
    var current = 0;
    var timer = null;
    function show(index) {
        current = (index + items.length) % items.length;
        items.forEach(function (el, i) { el.classList.toggle('active', i === current); });
        dots.forEach(function (el, i) { el.classList.toggle('active', i === current); });
    }
    function start() { if (!timer) timer = setInterval(function () { show(current + 1); }, 5000); }
    function stop() { if (timer) { clearInterval(timer); timer = null; } }
    function restart() { stop(); start(); }
    var prev = section.querySelector('.slide-prev');
    var next = section.querySelector('.slide-next');
    if (prev) prev.addEventListener('click', function () { show(current - 1); restart(); });
    if (next) next.addEventListener('click', function () { show(current + 1); restart(); });
    dots.forEach(function (dot, i) { dot.addEventListener('click', function () { show(i); restart(); }); });
    section.addEventListener('mouseenter', stop);
    section.addEventListener('mouseleave', start);
    section.addEventListener('touchstart', stop, { passive: true });
    section.addEventListener('touchend', start);
    start();
})();
</script>
@else
<section class="hero" id="beranda">
    <p style="font-size:1.6rem;color:#fbbf24">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
    <p>Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang</p>
    <h1>{{ $setting->nama_masjid }}</h1>
    <p class="gold">DESA BELAWA</p>
    <p style="max-width:640px;margin:0 auto">{{ config('mosque.tagline') }} — rumah ibadah dan pembinaan umat bagi warga Desa Belawa dan sekitarnya.</p>
    <p style="margin-top:20px">
        <a class="btn" href="#jadwal">Lihat Jadwal Sholat</a>
        <a class="btn2" href="#kegiatan">Kegiatan Masjid</a>
    </p>
</section>
@endif

<div class="wrap">
    <section>
        <div class="grid">
            @foreach (config('mosque.features') as $feature)
                <div class="card">
                    <div style="font-size:2rem">{{ $feature['icon'] }}</div>
                    <h3>{{ $feature['title'] }}</h3>
                    <p>{{ $feature['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section id="tentang">
        <p><b style="color:#b45309;letter-spacing:.15em">TENTANG MASJID</b></p>
        <h2>Rumah Allah, Pusat Komunitas</h2>
        <p>{{ config('mosque.description') }}</p>
        <p>DKM {{ $setting->nama_masjid }} mengajak seluruh jamaah untuk memakmurkan masjid: hadir berjamaah, mengikuti kajian, menyekolahkan anak di TPA/TPQ, serta berbagi melalui infaq dan sedekah.</p>
        <div class="card">
            <p><b>Nama:</b> {{ $setting->nama_masjid }}</p>
            <p><b>Lokasi:</b> Desa Belawa</p>
            <p><b>Alamat:</b> {{ $setting->alamat }}</p>
            <p><b>Pengelola:</b> Dewan Kemakmuran Masjid (DKM)</p>
        </div>
    </section>

    <section id="jadwal">
        <p><b style="color:#b45309;letter-spacing:.15em">JADWAL SHOLAT</b></p>
        <h2>Waktu Sholat Hari Ini</h2>
        <p>Jadwal diperbarui otomatis setiap hari dari API Aladhan (metode Kemenag RI, wilayah Cirebon). Datanglah lebih awal agar dapat mengikuti sholat berjamaah dengan khusyuk.</p>
        <div class="dark">
            <h3>Jadwal Sholat Hari Ini — Wilayah Cirebon &amp; sekitarnya</h3>
            @if ($prayer)
                @if (! empty($prayer['hijri']))
                    <p style="color:#fbbf24">{{ $prayer['hijri']['day'] ?? '' }} {{ $prayer['hijri']['month']['en'] ?? '' }} {{ $prayer['hijri']['year'] ?? '' }} H · {{ $prayer['date']['readable'] ?? '' }}</p>
                @endif
                <div class="prayer">
                    <div>Subuh<br><b>{{ substr($prayer['timings']['Fajr'] ?? '-', 0, 5) }}</b></div>
                    <div>Dzuhur<br><b>{{ substr($prayer['timings']['Dhuhr'] ?? '-', 0, 5) }}</b></div>
                    <div>Ashar<br><b>{{ substr($prayer['timings']['Asr'] ?? '-', 0, 5) }}</b></div>
                    <div>Maghrib<br><b>{{ substr($prayer['timings']['Maghrib'] ?? '-', 0, 5) }}</b></div>
                    <div>Isya<br><b>{{ substr($prayer['timings']['Isha'] ?? '-', 0, 5) }}</b></div>
                </div>
            @else
                <p>Jadwal sholat tidak dapat dimuat saat ini. Silakan periksa koneksi internet Anda, atau lihat jadwal di papan pengumuman masjid.</p>
            @endif
            <p class="muted" style="color:#a7f3d0">Sumber: Aladhan Prayer Times (metode Kemenag RI). Waktu dapat berbeda beberapa menit dengan jadwal resmi setempat.</p>
        </div>
    </section>

    <section id="kegiatan">
        <p><b style="color:#b45309;letter-spacing:.15em">KEGIATAN</b></p>
        <h2>Program &amp; Kegiatan</h2>
        @if ($kegiatans->isEmpty())
            <p>Belum ada kegiatan yang diumumkan. Silakan hubungi pengurus DKM.</p>
        @else
            <div class="grid">
                @foreach ($kegiatans as $kegiatan)
                    <article class="card">
                        @if ($kegiatan->fotoUrl())
                            <img class="resp" src="{{ $kegiatan->fotoUrl() }}" alt="{{ $kegiatan->judul }}">
                        @else
                            <div class="foto-kosong">Belum ada foto kegiatan</div>
                        @endif
                        <p class="muted">{{ $kegiatan->tanggal->format('d F Y') }}</p>
                        <h3><a href="{{ route('kegiatan.show', $kegiatan) }}">{{ $kegiatan->judul }}</a></h3>
                        <p>{{ \Illuminate\Support\Str::limit($kegiatan->deskripsi, 140) }}</p>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    <section id="khutbah">
        <p><b style="color:#b45309;letter-spacing:.15em">JADWAL KHUTBAH JUMAT</b></p>
        <h2>Jadwal Khutbah Jumat</h2>
        @if ($khutbahs->isEmpty())
            <p>Jadwal khutbah belum diumumkan. Silakan hubungi pengurus DKM.</p>
        @else
            <div class="table-wrap"><table>
                <thead><tr><th>Tanggal Jumat</th><th>Khatib</th><th>Imam</th><th>Muadzin</th><th>Tema</th></tr></thead>
                <tbody>
                    @foreach ($khutbahs as $khutbah)
                        <tr>
                            <td>{{ $khutbah->tanggal->format('d F Y') }}</td>
                            <td>{{ $khutbah->khatib }}</td>
                            <td>{{ $khutbah->imam }}</td>
                            <td>{{ $khutbah->muadzin }}</td>
                            <td>{{ $khutbah->tema ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table></div>
        @endif
    </section>

    <section id="struktur">
        <p><b style="color:#b45309;letter-spacing:.15em">STRUKTUR DKM</b></p>
        <h2>Pengurus Dewan Kemakmuran Masjid</h2>
        @if ($pengurus->isEmpty())
            <p>Struktur pengurus belum diumumkan.</p>
        @else
            <div class="grid">
                @foreach ($pengurus as $orang)
                    <div class="card" style="text-align:center">
                        @if ($orang->fotoUrl())
                            <img class="pengurus-foto" src="{{ $orang->fotoUrl() }}" alt="{{ $orang->nama }}">
                        @else
                            <div class="foto-kosong">Belum ada foto pengurus</div>
                        @endif
                        <h3>{{ $orang->nama }}</h3>
                        <p>{{ $orang->jabatan }}</p>
                    </div>
                @endforeach
            </div>
        @endif
        <p class="muted">Catatan: nama pengurus yang masih tertulis "Belum diisi" adalah data contoh dari seeder dan harus diganti dengan nama asli oleh admin.</p>
    </section>

    <section id="infaq">
        <div class="notice" style="text-align:center">
            <h2>Infaq &amp; Sedekah</h2>
            <p>Setiap infaq yang Anda titipkan digunakan untuk operasional masjid, kegiatan pembinaan umat, dan kemaslahatan jamaah. Semoga menjadi amal jariyah yang terus mengalir.</p>
            @if ($setting->infaqTersedia())
                <p><b>{{ $setting->nama_bank ?? '' }}</b><br><b style="font-size:1.3rem">{{ $setting->rekening_infaq }}</b><br>Atas nama pengurus masjid (konfirmasi ke DKM sebelum transfer).</p>
            @else
                <p><b>Rekening infaq: belum diisi DKM.</b><br>Rekening resmi infaq akan diumumkan oleh pengurus DKM. Untuk berinfaq, silakan hubungi pengurus DKM atau datang langsung ke masjid. Nomor rekening tidak ditampilkan karena belum dikonfirmasi — jangan transfer ke nomor rekening yang tidak resmi.</p>
            @endif
        </div>
    </section>

    <section id="kontak">
        <p><b style="color:#b45309;letter-spacing:.15em">KONTAK &amp; LOKASI</b></p>
        <h2>Kunjungi Masjid Kami</h2>
        <div class="grid">
            <div class="card">
                <h3>Alamat</h3>
                <p>{{ $setting->alamat }}</p>
                <p><a href="{{ config('mosque.maps_url') }}" target="_blank" rel="noreferrer">Lihat di Google Maps</a></p>
                <p class="muted">Plus Code: {{ config('mosque.plus_code') }}</p>
            </div>
            <div class="card">
                <h3>Telepon / WhatsApp</h3>
                <p>{{ $setting->telepon ?? 'Belum diisi DKM — menunggu konfirmasi pengurus DKM' }}</p>
                <h3>Email</h3>
                <p>{{ $setting->email ?? 'Belum diisi DKM' }}</p>
            </div>
            <div class="card">
                <h3>Pengelola</h3>
                <p>Dewan Kemakmuran Masjid (DKM) {{ $setting->nama_masjid }}</p>
            </div>
        </div>
    </section>
</div>
@endsection
